<?php

namespace Modules\Polls\Http\Controllers\Frontend;

use Session,View,Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Polls\Repositories\Frontend\MyPollsRepositoryInterface as MyPollsRepo;

class MyPollsController extends Controller
{
    public function __construct(MyPollsRepo $MyPollsRepo)
    {
        $this->middleware(['auth']);
        $this->MyPollsRepo = $MyPollsRepo;
    }

    /**
     * save poll data into database by user id.
     * @return Response
     */
    public function voteForPoll(Request $request)
    {
        $record = $this->MyPollsRepo->submitVoteForPolls($request);
    }
}