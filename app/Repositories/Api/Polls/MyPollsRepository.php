<?php

namespace App\Repositories\Api\Polls;

use DB,Mail;
use Carbon\Carbon;
use Modules\Polls\Entities\Polls;
use Modules\Polls\Entities\UserPollVotes;


class MyPollsRepository implements MyPollsRepositoryInterface {

    function __construct(Polls $Polls,UserPollVotes $UserPollVotes) {
       $this->Polls = $Polls;
       $this->UserPollVotes = $UserPollVotes;
    }

    public function getPolls()
    {
      $polls = $this->Polls->with('options')->where('status',1)->get();
      $response = array();
      foreach ($polls as $key => $poll) {
        $response[$key]['id'] = $poll->id;
        $response[$key]['question'] = $poll->question;
        foreach ($poll->options as $optKey => $option) {
          $response[$key]['option'][$optKey]['id'] = $option->id;
          $response[$key]['option'][$optKey]['name'] = $option->name;
        }
      }
      return $response;
    }


    public function updateUserVote($request)
    {
      foreach ($request->get('answer') as $pId => $opId) {
        if($opId != NULL && $opId != ''){
          $this->UserPollVotes->create([
            'user_id' => auth()->user()->id,
            'poll_id' => $pId,
            'polls_option_id' => $opId
          ]);
        }
      }
      $response['message'] = 'sucessfully updated';
      $response['status_code'] = 200;
      return $response;
    }

   
   /**
   * return unathentication message with error code 500
   * @return \Illuminate\Http\Response
   */
    public function ValidateHeader()
    {
        return $this->response->array(["message"=>"Unauthenticated","status_code"=>500])->setStatusCode(500);
    }
}
