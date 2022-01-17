<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPSTORM_META\type;

class CreateStudentMarksTable extends Migration
{
    public function up()
    {
        Schema::create('student_marks', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('class_id');
            $table->integer('course_id');
            $table->integer('semester_id');
            $table->integer('is_point');
            $table->double('half_mark')->nullable();
            $table->double('final_mark')->nullable();
            $table->integer('result')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('student_marks');
    }
}
