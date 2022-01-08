<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_name',
        'email',
        'gender',
        'mobileNumber',
        'dateOfBirth',
        'special',
        'address',
        // 'upload',
    ];
    public function teacherLessons()
    {
        return $this->hasMany(Lesson::class, 'teacher_id', 'id');
    }
}
