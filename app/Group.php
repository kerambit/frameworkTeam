<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Get the students for the group.
     */
    public function articles()
    {
        return $this->hasMany('App\User');
    }
}
