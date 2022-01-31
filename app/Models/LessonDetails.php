<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonDetails extends Model
{
    use HasFactory;
    protected $fillable = ['lesson_title', 'date', 'lesson_id'];
}
