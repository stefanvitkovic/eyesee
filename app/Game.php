<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = true;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function levels()
    {
        return $this->hasMany('App\Level');
    }
}
