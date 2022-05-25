<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseNoSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_no_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('price_item_id');
            $table->string('license_no_sale_number')->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->integer('create_by')->nullable();
            $table->integer('update_by')->nullable();
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
        Schema::dropIfExists('license_no_sales');
    }
}
