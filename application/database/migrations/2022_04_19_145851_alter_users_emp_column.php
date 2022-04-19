<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersEmpColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->tinyinteger('emp_type')->default(1)->comment('1=users,2=employees');
        //     $table->string('emp_code');
        //     $table->string('dept');
        //     $table->string('designation');
        //     $table->string('rm');
        //     $table->date('doj');
        //     $table->string('phone');
        // });
        // DB::statement('UPDATE `users` SET `emp_type`=1'); 
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
