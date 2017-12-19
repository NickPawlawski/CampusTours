<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Carbon\Carbon;

class Tour extends Model
{
	use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date'
    ];

    /* Returns a carbon object containing the date and time of the tour. This
       can be helpful when both are needed at once. */
    public function dateTime()
    {
    	$dateString = date('Y-m-d', $this->date->timestamp);
    	return new Carbon($dateString . ' ' . $this->time);
    }

    public function attendees()
    {
        return $this->hasMany('App\Attendee');
    }
}
