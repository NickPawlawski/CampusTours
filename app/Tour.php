<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];
}
