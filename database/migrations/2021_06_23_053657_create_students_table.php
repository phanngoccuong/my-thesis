<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('registrationDate')->nullable();
            $table->string('class_id')->nullable();
            $table->smallInteger('gender')->default(1)->comment('1-name, 2-nu,0-other');
            $table->string('father_name')->nullable();
            $table->string('father_number')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_number')->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->string('address')->nullable();
            $table->text('upload')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('students');
    }
}
