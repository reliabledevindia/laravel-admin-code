<?php

namespace Modules\Polls\Repositories\Frontend;

use DB,Mail,Session;
use Carbon\Carbon;
use Modules\Polls\Entities\Polls;
use Modules\Polls\Entities\UserPollVotes;
use Illuminate\Support\Facades\Input;


class MyPollsRepository implements MyPollsRepositoryInterface {


    function __construct(Polls $Polls,UserPollVotes $UserPollVotes) {
       $this->Polls = $Polls;
       $this->UserPollVotes = $UserPollVotes;
    }

    public function submitVoteForPolls($request)
    {
       //
    }
}
