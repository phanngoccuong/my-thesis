<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotions';
    protected $fillable = [
        'student_id', 'session_id', 'class_id'
    ];
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function year()
    {
        return $this->belongsTo(YearSession::class, 'session_id');
    }
}
