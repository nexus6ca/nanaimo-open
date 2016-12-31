<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    // Relationship to Players - one player many tournament
    public function users()
    {
        return $this->belongsToMany('App\User', 'tournament_user')->withPivot('byes')->withPivot('paid')->withTimestamps();
    }
}
