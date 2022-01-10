<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignTeacher extends Model
{
    use HasFactory;
    protected $fillable = ['class_id', 'teacher_id', 'session_id'];
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function year()
    {
        return $this->belongsTo(YearSession::class, 'session_id');
    }
}
