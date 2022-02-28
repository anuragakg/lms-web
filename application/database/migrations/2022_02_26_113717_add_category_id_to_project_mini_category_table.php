<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToProjectMiniCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_mini_category', function (Blueprint $table) {
            $table->tinyinteger('form_type')->default(1)->after('id')->comment('1=mini category,2-lead');
            $table->integer('category_id')->nullable()->after('product_form_mini_id');
            $table->integer('sub_category_id')->nullable()->after('product_form_mini_id');
            $table->integer('product_vertical_id')->nullable()->after('product_form_mini_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_mini_category', function (Blueprint $table) {
            $table->dropColumn('category_id');
            $table->dropColumn('sub_category_id');
            $table->dropColumn('product_vertical_id');
        });
    }
}
