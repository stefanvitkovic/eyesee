<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public $timestamps = true;
    protected $guarded = [];

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function stats()
    {
        return $this->hasMany('App\Stats');
    }
}
