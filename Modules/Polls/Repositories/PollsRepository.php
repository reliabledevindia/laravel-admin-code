<?php

namespace Modules\Polls\Repositories;


use DB,Mail,Session,DataTables;
use Modules\Polls\Entities\Polls;
use Modules\Polls\Entities\PollOptions;
use Illuminate\Support\Facades\Input;


class PollsRepository implements PollsRepositoryInterface {

    public $Polls;
    protected $model = 'Polls';

    function __construct(Polls $Polls,PollOptions $PollOptions) {
        $this->Polls = $Polls;
        $this->PollOptions = $PollOptions;
    }

    public function getRecord($id)
    {
      return $this->Polls->find($id);
    }

    public function getRecordBySlug($slug)
    {
      return $this->Polls->findBySlug($slug);
    }
    public function getAjaxData($request)
    {
        try {
           DB::statement(DB::raw('set @rownum=0'));
            $model = $this->model;
            $lists = $this->$model->select('*', DB::raw('@rownum  := @rownum  + 1 AS rownum'))->latest()->get();
            return DataTables::of($lists)
               ->addColumn('action', function($list) use($model){
                        $dispalyButton = displayButton(['deleteAjax'=>[strtolower($model).'.destroy', [$list->slug]], 'edit'=>[strtolower($model).'.edit', [$list->slug]]]);
                        $edit = $delete = '';
                        if(auth()->user()->checkPermissionTo(strtolower($model).'.edit','admin'))
                        $edit = keyExist($dispalyButton, 'edit');
                        if(auth()->user()->checkPermissionTo(strtolower($model).'.destroy','admin'))
                        $delete = keyExist($dispalyButton, 'deleteAjax');
                        return $edit;
                    })  
                ->editColumn('question', function($list){
                    return \Illuminate\Support\Str::limit($list->question, 250, '...');
                })
                ->editColumn('created_at', function($list){
                    return $list->created_at->format(\Config::get('custom.default_date_formate'));
                }) 
                ->editColumn('status', function($list){
                    return ($list->status==1) ? '<span class="label label-success">'.trans('menu.active').'</span>' : '<span class="label label-danger">'.trans('menu.inactive').'</span>';
                })
                ->rawColumns(['status','action'])
                ->make(true);
        } 
        catch (Exception $ex) {
            return false;
        }        
    }

    public function store($request)
    {
        try {
            $filleable = $request->only( 'slug','question','option');
            $this->Polls->fill($filleable);
            if($this->Polls->save()){
                $poll_id = DB::getPDO()->lastInsertId();
                if(count($request->get('option'))>0){
                    foreach ($request->get('option') as $key => $option) {
                        $insert[$key]['poll_id'] = $poll_id;
                        $insert[$key]['name'] = $option;
                        $insert[$key]['created_at'] = now();
                        $insert[$key]['updated_at'] = now();
                    }
                    $this->PollOptions->insert($insert);
                }
                $response['message'] = trans('flash.success.polls_created_successfully');
                $response['type']    = 'success';
                $response['status_code'] = 200;
                $response['url']     =  route('polls.index');
                $response['reset']   = 'true';
            }else{
                $response['message'] = trans('flash.error.oops_something_went_wrong_creating_record');
                $response['type'] = 'error';  
            }
        }catch (Exception $ex) {
            $response['message'] = trans('flash.error.oops_something_went_wrong_creating_record');
            $response['type'] = 'error';
        }  
         return $response;
    }

    public function update($request,$id)
    {
        try {
            $filleable = $request->only('slug','question','option');
            $record = $this->getRecord($id);
            $record->fill($filleable);
            if($record->save()){
                if(count($request->get('option'))>0){
                    foreach ($request->get('option') as $key => $option) {
                        $record->options->find($key)->update(array('name'=>$option));
                    }
                }
                $response['message'] = trans('flash.success.polls_updated_successfully');
                $response['type']    = 'success';
            }else{
                $response['message'] = trans('flash.error.oops_something_went_wrong_updating_record');
                $response['type'] = 'error';  
            }
        }catch (Exception $ex) {
            $response['message'] = trans('flash.error.oops_something_went_wrong_updating_record');
            $response['type'] = 'error';
        } 
        return $response;
    }

    public function destroy($id)
    {
      return $this->Polls->destroy($id);
    }
}