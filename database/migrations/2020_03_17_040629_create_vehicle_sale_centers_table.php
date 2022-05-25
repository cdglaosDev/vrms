<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleSaleCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_sale_centers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('province_code');
            $table->string('district_code');
            $table->string('village_code');
            $table->string('name');
            $table->string('name_en');
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->string('log_activiy');
            $table->string('contract')->nullable();
            $table->boolean('status')->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('village_code')->references('village_code')->on('villages')->onDelete('cascade');
             $table->foreign('district_code')->references('district_code')->on('districts')->onDelete('cascade');
              $table->foreign('province_code')->references('province_code')->on('provinces')->onDelete('cascade');

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
        Schema::dropIfExists('vehicle_sale_centers');
    }
}
