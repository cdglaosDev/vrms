<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->text('text');
            $table->integer('money_unit_id');
            $table->integer('price');
            $table->integer('vehicle_type_id');
            $table->integer('vehicle_model_id');
            $table->integer('vehicle_brand_id');
            $table->string('item_car_gen');
            $table->string('item_car_power');
            $table->integer('standard_id');
            $table->string('item_car_used');
            $table->integer('steering_id');
            $table->string('item_car_seat');
            $table->string('item_car_manufacture');
            $table->string('car_height');
            $table->string('car_long');
            $table->integer('gas_id');
            $table->string('car_wheels');
            $table->string('car_acels');
            $table->string('car_color');
            $table->string('car_engine_number');
            $table->string('car_tank_number');
            $table->string('car_weight');
            $table->string('car_total_weight');
            $table->string('car_tech');
            $table->string('car_width');
            $table->integer('car_number');
            $table->integer('car_number_type');
            $table->datetime('deleted_at');
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
        Schema::dropIfExists('vehicles');
    }
}
