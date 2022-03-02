<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbilityQuality extends Model
{
    use HasFactory;
    protected $fillable = [
        'self_management',
        'cooperate',
        'problem_solving',
        'hard_work',
        'self_confident',
        'honesty',
        'united',
        'student_id', 'class_id', 'session_id'
    ];
    public function year()
    {
        return $this->belongsTo(YearSession::class, 'session_id');
    }
}
