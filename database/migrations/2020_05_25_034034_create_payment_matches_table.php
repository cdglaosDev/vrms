<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_purpose_id');
            $table->unsignedBigInteger('vehicle_category_id');
            $table->unsignedBigInteger('price_item_id');
            $table->foreign('app_purpose_id')->references('id')->on('app_purposes')->onDelete('cascade');
            $table->foreign('vehicle_category_id')->references('id')->on('vehicle_categories')->onDelete('cascade');
            $table->foreign('price_item_id')->references('id')->on('price_items')->onDelete('cascade');
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
        Schema::dropIfExists('payment_matches');
    }
}
