<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectVerticalStatusModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_vertical_status', function (Blueprint $table) {
            $table->id();
            $table->tinyinteger('status')->comment('1=>approved,2=reject,0=pending');
            $table->string('user_type');
            $table->integer('product_id');
            $table->integer('updated_by');
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
        Schema::dropIfExists('project_vertical_status_models');
    }
}
