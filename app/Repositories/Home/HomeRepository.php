<?php

namespace App\Repositories\Home;

use Modules\Polls\Entities\Polls;

class HomeRepository implements HomeRepositoryInterface {

    function __construct(Polls $Polls) {
       $this->Polls = $Polls;
    }

    public function getPollLists()
    {
        return $this->Polls->where('status',1)->with('options')->get();
    }
}