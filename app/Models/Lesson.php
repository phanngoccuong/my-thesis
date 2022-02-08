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
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function room()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }
    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
