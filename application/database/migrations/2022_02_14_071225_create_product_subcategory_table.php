<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_subcategory', function (Blueprint $table) {
            $table->id();
            $table->string('sub_category');
            $table->integer('category_id');
            $table->integer('product_vertical_id');
            $table->integer('product_form_mini_id');
            $table->integer('product_form_lead_id');
			
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
        Schema::dropIfExists('product_subcategory');
    }
}
