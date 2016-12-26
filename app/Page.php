<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    // A page has a 1 to 1 relationship to a User
    public function User() {
        return $this->belongsTo('App\User', 'id');
    }
}
