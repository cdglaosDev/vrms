<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseNoPresentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_no_presents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('province_code');
            $table->unsignedBigInteger('vehicle_type_id');
            $table->unsignedBigInteger('license_alphabet_id');
            $table->string('license_no_present_number')->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->integer('create_by')->nullable();
            $table->integer('update_by')->nullable();
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
            $table->foreign('license_alphabet_id')->references('id')->on('license_alphabets')->onDelete('cascade');
           
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
        Schema::dropIfExists('license_number_presents');
    }
}
