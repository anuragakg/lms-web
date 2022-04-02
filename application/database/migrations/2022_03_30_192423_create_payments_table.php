<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->integer('program_id');
            $table->decimal('installment_total',8,2);
            $table->decimal('gross_payable',8,2);
            $table->decimal('exemption',8,2);
            $table->decimal('base_fee',8,2);
            $table->decimal('gst_applicable',8,2);
            $table->decimal('net_base_fee',8,2);
            $table->integer('added_by');
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
        Schema::dropIfExists('payments');
    }
}
