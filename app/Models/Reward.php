<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id', 'semester_id', 'student_reward', 'class_id'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
