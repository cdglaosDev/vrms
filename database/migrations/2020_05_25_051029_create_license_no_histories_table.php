<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseNoHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_no_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('license_alphabet_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->enum('license_no_status',['uses', 'not_uses']); 
            $table->string('license_no_number')->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->integer('create_by')->nullable();
            $table->integer('update_by')->nullable();
            $table->softDeletes();
            $table->foreign('license_alphabet_id')->references('id')->on('license_alphabets')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
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
        Schema::dropIfExists('license_no_histories');
    }
}
