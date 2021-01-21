<?php

namespace App\Repositories\Api\Polls;


interface MyPollsRepositoryInterface
{
    public function getPolls();

    public function updateUserVote($request);
}

