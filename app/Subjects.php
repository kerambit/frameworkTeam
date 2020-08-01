<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Get the subject for student.
     */
    public function marks()
    {
//        return $this->belongsToMany('App\User', 'marks', 'subject_id', 'student_id');
        return $this->hasMany('App\Marks', 'subject_id', 'id');
    }
}
