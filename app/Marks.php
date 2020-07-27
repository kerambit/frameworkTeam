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
}
