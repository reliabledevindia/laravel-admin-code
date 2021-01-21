<?php

namespace Modules\Polls\Repositories\Frontend;


interface MyPollsRepositoryInterface
{
    public function submitVoteForPolls($request);
}