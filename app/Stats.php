<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    public $timestamps = true;
    protected $guarded = [];

    public function levels()
    {
        return $this->hasMany('App\Level');
    }

    public function users()
    {
        return $this->hasMany('App\User','id','user_id');
    }
}
