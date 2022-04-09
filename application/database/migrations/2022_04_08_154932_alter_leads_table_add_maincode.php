<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLeadsTableAddMaincode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('leads', function (Blueprint $table) {
            $table->string('main_code')->default(null)->unique();
            $table->string('parent_code')->default(null);
        });
        DB::statement('UPDATE `leads` SET `main_code`=null'); 
        DB::statement('ALTER TABLE `leads` ADD UNIQUE(`main_code`)'); 
        DB::statement('ALTER TABLE `leads` ADD UNIQUE `unique_index`(`email`,`phone`)'); 
        DB::statement('ALTER TABLE `leads` CHANGE `parent_code` `parent_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL'); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
