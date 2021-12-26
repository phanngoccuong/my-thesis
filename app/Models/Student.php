<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use Notifiable;
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'registrationDate',
        'class_id',
        'gender',
        'father_name',
        'father_number',
        'mother_name',
        'mother_number',
        'dateOfBirth',
        'address',
        'upload',
    ];
    public function classes()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }
    public function batches()
    {
        return $this->hasOne(Batch::class, 'id', 'batch_id');
    }
}
