<?php

namespace Modules\Polls\Entities;

use Illuminate\Database\Eloquent\Model;

class PollOptions extends Model
{
	protected $table = "polls_options";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'poll_id','name','created_at'
    ];
}
