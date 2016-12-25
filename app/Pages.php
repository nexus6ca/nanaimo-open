<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    // A page has a 1 to 1 relationship to a User
    public function User() {
        return $this->belongsTo('App\User', 'id');
    }
}
