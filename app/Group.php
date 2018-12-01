<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $hidden = [
        'pivot', 'created_at', 'updated_at'
    ];

    public function users() {
        return $this->hasMany('App\User');
    }
}
