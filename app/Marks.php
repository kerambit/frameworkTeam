<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    protected $fillable = [
      'subject_id',
      'student_id',
      'mark'
    ];

    public function student()
    {
        return $this->belongsTo('App\User', 'student_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subjects', 'subject_id', 'id');
    }
}
