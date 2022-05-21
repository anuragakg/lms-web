<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersAddNewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->string('official_contact_number');
            $table->string('emergency_contact_number');
            $table->string('relation_contact_number');
            $table->string('personal_email');
            $table->string('perm_address');
            $table->string('comm_address');
            $table->string('aadhar');
            $table->string('pan_number');
        });
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
