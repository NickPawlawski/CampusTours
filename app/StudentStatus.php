<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentStatus extends Model
{
    use SoftDeletes;

    protected $table = 'student_status';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}