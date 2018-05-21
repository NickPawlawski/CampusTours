<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BugStatus extends Model
{
    //

    public function bug()
    {
        return $this->belongsTo('App\Bug');
    }
}
