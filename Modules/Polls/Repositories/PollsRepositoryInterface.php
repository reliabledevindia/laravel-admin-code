<?php

namespace Modules\Polls\Repositories;


interface PollsRepositoryInterface
{
    public function getRecord($id);
    
    public function getRecordBySlug($slug);

    public function getAjaxData($request);

    public function store($request);

    public function update($request,$id);

    public function destroy($id);
}