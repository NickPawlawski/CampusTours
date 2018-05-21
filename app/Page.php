<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $table = 'pages';

    public function bug()
    {
        return $this->belongsTo('App\Bug');
    }
}
