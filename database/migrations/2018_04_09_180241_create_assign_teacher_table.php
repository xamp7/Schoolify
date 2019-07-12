<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignTeacher', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sectionId');
            $table->integer('facultyId')->unsigned();
            $table->integer('subjectId');
            $table->timestamps();

            $table->foreign('facultyId')
                  ->references('id')
                  ->on('faculties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignTeacher');
    }
}
