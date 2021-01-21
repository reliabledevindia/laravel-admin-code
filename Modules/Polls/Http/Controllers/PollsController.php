<?php

namespace Modules\Polls\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Polls\Http\Requests\CreatePollsRequest;
use Modules\Polls\Http\Requests\UpdatePollsRequest;
use Modules\Polls\Repositories\PollsRepositoryInterface as PollsRepo;

class PollsController extends Controller
{
    public function __construct(PollsRepo $PollsRepo)
    {
        $this->middleware(['ability','auth']);
        $this->PollsRepo = $PollsRepo;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        if(request()->ajax()) 
        {
            return $this->PollsRepo->getAjaxData($request);
        }
        return view('polls::index')->withModel('polls');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('polls::create')->withModel('polls');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CreatePollsRequest $request)
    {
        $response = $this->PollsRepo->store($request);
        if($request->ajax()){
            return response()->json($response);
        }
        Session::flash($response['type'], $response['message']); 
        return redirect()->route('polls.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Request $request,$slug)
    {
        $data =  $this->PollsRepo->getRecordBySlug($slug);
        if($data){
          return view('polls::edit',compact('data'))->withModel('polls');  
        }
        Session::flash('error', trans('flash.error.reocrd_not_available_now'));
        return redirect()->route('polls.index');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdatePollsRequest $request, $id)
    {
        $data =  $this->PollsRepo->getRecord($id);
        if($data){
            $response = $this->PollsRepo->update($request,$id);
            if($request->ajax()){
                return response()->json($response);
            }
            Session::flash($response['type'], $response['message']); 
            return redirect()->route('polls.index');
        }
        Session::flash('error', trans('flash.error.reocrd_not_available_now'));
        return redirect()->route('polls.index');
    }
    
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request,$slug)
    {
        try{
            $data =  $this->PollsRepo->getRecordBySlug($slug);
            if($data){
                $this->PollsRepo->destroy($data->id);
                $type = 'success'; $message = trans('flash.success.polls_deleted_successfully');
                if($request->ajax()){
                    return response()->json(['status_code'=> 200, 'type'=>$type,'message' => $message]);
                }
                Session::flash($type, $message);
                return redirect()->route('polls.index');
            }
            if($request->ajax()){
                return response()->json(['status_code'=> 200, 'type'=>'error','message' => trans('flash.error.oops_reocrd_not_available')]);
            }
            Session::flash('error', trans('flash.error.oops_reocrd_not_available'));
            return redirect()->route('polls.index');
        }catch (QueryException $e){
            if($request->ajax()){
                return response()->json(['status_code'=> 200, 'type'=>'error','message' => trans('flash.error.cant_delete_reocrd_try_later')]);
            }
            Session::flash('warning', trans('flash.error.cant_delete_reocrd_try_later'));
            return redirect()->route('polls.index');
        }
    }
}