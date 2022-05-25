<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no');
            $table->string('ref_no');
            $table->date('date');
            $table->integer('user_payee');
            $table->integer('user_payer');
            $table->integer('cost_total');
            $table->boolean('status')->default(1);
            $table->string('province_code');
            $table->integer('payment_status_id');
            $table->integer('reciept_status_id');
            $table->unsignedBigInteger('service_counter_id');
            $table->unsignedBigInteger('money_unit_id');
            
            $table->foreign('service_counter_id')->references('id')->on('service_counters')->onDelete('cascade');
            $table->foreign('money_unit_id')->references('id')->on('money_units')->onDelete('cascade');
             
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_lists');
    }
}
