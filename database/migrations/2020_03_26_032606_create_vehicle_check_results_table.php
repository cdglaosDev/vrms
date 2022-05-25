<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleCheckResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_check_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('app_form_id');
            $table->string('name');
            $table->text('result');
            $table->text('remark');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('vehicle_check_results');
    }
}
