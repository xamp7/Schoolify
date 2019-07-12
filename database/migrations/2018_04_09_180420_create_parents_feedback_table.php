<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parentsFeedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subjectId');
            $table->string('title');

            $table->integer('studentId');
            $table->integer('facultyId');
            $table->integer('seen')->default(0);

            $table->string('feedback');

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
        Schema::dropIfExists('parentsFeedback');
    }
}
