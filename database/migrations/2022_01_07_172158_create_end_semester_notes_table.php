<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndSemesterNotesTable extends Migration
{

    public function up()
    {
        Schema::create('end_semester_notes', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->string('conduct');
            $table->string('student_id');
            $table->unsignedInteger('semester_id');
            $table->string('student_type');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('end_semester_notes');
    }
}
