<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('province_code');
            $table->string('district_code');
            
             $table->string('name');
             $table->string('name_en');
             
             $table->boolean('status')->default(1);
             $table->foreign('province_code')->references('province_code')->on('provinces')->onDelete('cascade');
             $table->foreign('district_code')->references('district_code')->on('districts')->onDelete('cascade');
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
        Schema::dropIfExists('departments');
    }
}
