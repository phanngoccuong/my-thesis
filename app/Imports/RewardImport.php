<?php

namespace App\Imports;

use App\Models\Reward;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class RewardImport implements ToModel
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Reward([
            'student_id' => $row[0],
            'class_id' => $row[1],
            'semester_id' => $row[2],
            'student_reward' => $row[3],
        ]);
    }
}
