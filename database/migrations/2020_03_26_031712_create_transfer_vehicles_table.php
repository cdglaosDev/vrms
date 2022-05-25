<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('app_number');
            $table->string('transer_from');
            $table->string('transer_to');
            $table->string('old_vehicle_number');
            $table->string('new_vehicle_number');
            $table->datetime('date');
            $table->text('remark');
            $table->boolean('status')->default(1);
            $table->integer('apply_by');
            $table->integer('approved_officer');
            $table->datetime('deleted_at');
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
        Schema::dropIfExists('transfer_vehicles');
    }
}
