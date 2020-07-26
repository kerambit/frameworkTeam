<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Get the subjects for student.
     */
    public function marks()
    {
        return $this->belongsToMany('App\Marks', 'marks', 'subject_id', 'student_id');
    }
}
