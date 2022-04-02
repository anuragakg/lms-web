<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterInstalmentAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_installments', function (Blueprint $table) {
            $table->decimal('w_fee',8,2);
            $table->decimal('gst',8,2);
            $table->decimal('total_received',8,2);
            $table->string('mop');
            $table->string('received_by');
            $table->date('received_date');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('total_received',8,2);
            $table->decimal('balance_due',8,2);
            
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
