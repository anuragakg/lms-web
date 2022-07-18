<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('added_by');
            $table->timestamps();
        });
        Schema::create('forms_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id');
            $table->text('question');
            $table->text('element_type');
            $table->timestamps();
        });
        Schema::create('questions_options', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id');
            $table->integer('question_id');
            $table->text('option_text');
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
        Schema::dropIfExists('forms');
    }
}
