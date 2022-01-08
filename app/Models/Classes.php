<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_name',
        'group_id'
    ];

    public function classLessons()
    {
        return $this->hasMany(Lesson::class, 'class_id', 'id');
    }
}
