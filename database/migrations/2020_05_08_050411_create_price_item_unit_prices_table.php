<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceItemUnitPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_item_unit_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('price_item_id');
            $table->string('province_code');
            $table->integer('unit_price');
            $table->integer('fine_percent');
            $table->integer('money_unit_id');
            $table->boolean('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('price_item_unit_prices');
    }
}
