<?php

namespace App\Http\Controllers\Api\Polls;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Repositories\Api\Polls\MyPollsRepositoryInterface as MyPollsRepo;

class MyPollsController extends BaseController
{
      public function __construct(MyPollsRepo $MyPollsRepo)
      {
        $this->MyPollsRepo = $MyPollsRepo;
      }

    /**
     * Display a listing of the resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function getPolls()
    {
        $response = $this->MyPollsRepo->getPolls();
        return response()->json(["data"=>$response,"error"=>false,"message"=>'success']);
    }    

    public function updateUserVote(Request $request)
    {
        $response = $this->MyPollsRepo->updateUserVote($request);
        return response()->json(["data"=>$response,"error"=>false,"message"=>'success']);
    }
}