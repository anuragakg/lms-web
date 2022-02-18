<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVerticalModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_vertical_models', function (Blueprint $table) {
            $table->id();
            $table->string('title');
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
        Schema::dropIfExists('product_vertical_models');
    }
}
