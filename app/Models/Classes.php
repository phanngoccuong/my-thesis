<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_name',
        'formteacher_id'
    ];
    public function formTeacher()
    {
        return  $this->hasOne(Teacher::class, 'id', 'formteacher_id');
    }
}
