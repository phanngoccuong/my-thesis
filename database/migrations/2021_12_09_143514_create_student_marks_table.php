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
            $table->integer('class_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('semester_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->double('mark')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('student_marks');
    }
}
