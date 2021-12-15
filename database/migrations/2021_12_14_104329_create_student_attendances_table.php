<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('class_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('semester_id')->nullable();
            $table->date('date')->nullable();
            $table->integer('status')->nullable()->comment('0-vắng,1-có,2-nghỉ có phép');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_attendances');
    }
}
