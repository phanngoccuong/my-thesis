<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendances extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }
}
