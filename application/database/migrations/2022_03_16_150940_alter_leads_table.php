<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('alternate_no')->after('phone')->nullable();
            $table->string('source')->nullable()->index();
            $table->string('ad_id')->nullable();
            $table->string('ad_name')->nullable();
            $table->string('adset_id')->nullable();
            $table->string('adset_name')->nullable();
            $table->string('campaign_id')->nullable();
            $table->string('campaign_name')->nullable();
            $table->string('form_id')->nullable();
            $table->string('form_name')->nullable();
            $table->boolean('is_organic')->nullable();
            $table->string('platform')->nullable();
            $table->dateTime('created_time')->nullable();
            $table->string('allowbroadcast')->nullable();
            $table->string('allowsms')->nullable();
            $table->string('leadmap')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('labels')->nullable();
            $table->string('subscription_status')->nullable();
            $table->string('last_activity')->nullable();
            $table->date('last_activity_date')->nullable();
            
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
