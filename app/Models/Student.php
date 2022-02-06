<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use Notifiable;
    use HasFactory;
    public $table = 'students';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'gender',
        'father_name',
        'father_number',
        'mother_name',
        'mother_number',
        'dateOfBirth',
        'address',
        'batch_id'
    ];

    public function batches()
    {
        return $this->hasOne(Batch::class, 'id', 'batch_id');
    }
}
