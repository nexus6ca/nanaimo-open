<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SitePage extends Model
{
    protected $fillable = [
        'home', 'next_tournament', 'previous_tournament',
    ];

    public $timestamps = false;

    public function pages(){
        return $this->hasMany('App\Page', 'id');
    }
}
