<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendee extends Model
{
    use SoftDeletes;
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function tour()
    {   
        return $this->belongsTo('App\Tour');
    }


}