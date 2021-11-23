<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $time = now();
        for ($i = 1; $i <= 10000; $i++) {
            Student::insert([
                'name' => $faker->name,
                'class_id' => 1,
                'gender' => rand(1, 2),
                'mobileNumber' => $faker->phoneNumber,
                'father_name' => $faker->name,
                'mother_name' => $faker->name,
                'father_number' => $faker->phoneNumber,
                'mother_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'created_at' => $time,
                'updated_at' => $time,
            ]);
        }
    }
}
