<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    public $table = 'bug';

    public function page()
    {
        return $this->has('App\Page');
    }

    public function bugStatus()
    {
        return $this->has('App\BugStatus');
    }
}
