<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectMiniCategoryModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_mini_category', function (Blueprint $table) {
            $table->id();
            $table->integer('product_form_mini_id');
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('website')->nullable();
            $table->string('speaks')->nullable();
            $table->string('industry')->nullable();
            $table->string('notes')->nullable();
            $table->string('company_name')->nullable();
            $table->string('process_status')->nullable();
            $table->string('rating')->nullable();
            $table->string('lead_temp')->nullable();
            $table->string('assigned')->nullable();
            $table->string('status_field')->nullable();
            $table->string('source')->nullable();
            $table->boolean('status')->default(0);
            $table->bigInteger('added_by');
            $table->bigInteger('approved_by');
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_mini_category_models');
    }
}
