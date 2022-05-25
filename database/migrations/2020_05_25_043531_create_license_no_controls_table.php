<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseNoControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_no_controls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('province_code');
            $table->unsignedBigInteger('vehicle_type_id');
            $table->unsignedBigInteger('license_alphabet_id');
            $table->unsignedBigInteger('license_alphabet_control_status_id');
            $table->boolean('status')->default(1)->nullable();
            $table->integer('create_by')->nullable();
            $table->integer('update_by')->nullable();
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
            $table->foreign('license_alphabet_id')->references('id')->on('license_alphabets')->onDelete('cascade');
            $table->foreign('license_alphabet_control_status_id')->references('id')->on('license_alphabet_control_statuses')->onDelete('cascade');
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
        Schema::dropIfExists('license_number_controls');
    }
}
