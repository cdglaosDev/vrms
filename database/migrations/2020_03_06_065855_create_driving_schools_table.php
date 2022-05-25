<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrivingSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driving_schools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('district_code');
            $table->string('province_code');
            $table->string('village_code');
            
             $table->string('name');
             $table->string('name_en');
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->string('log_activiy');
            $table->string('contract')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('driving_schools');
    }
}
