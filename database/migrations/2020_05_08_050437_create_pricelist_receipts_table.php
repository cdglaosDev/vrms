<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricelistReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricelist_receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('receipt_no');
            $table->string('item_code');
            $table->string('item_name');
            $table->string('item_name_en');
            $table->integer('item_qty');
            $table->integer('item_unit_price');
            $table->integer('money_unit_id');
            $table->double('total_price', 10, 2);
            $table->string('province');
            $table->string('counter_no');
            $table->unsignedBigInteger('price_list_id');
            $table->foreign('price_list_id')->references('id')->on('price_lists')->onDelete('cascade');
            $table->integer('create_by')->nullable();
            $table->softDeletes();

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
        Schema::dropIfExists('pricelist_receipts');
    }
}
