<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'class_id',
        'classroom_id',
        'teacher_id',
        'day_id',
        'time_id',
        'semester_id'
    ];
}
