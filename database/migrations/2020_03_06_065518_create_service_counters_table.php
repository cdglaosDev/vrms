<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_counters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('district_code');
            
            $table->string('name');
            $table->string('name_en');
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('service_counters');
    }
}
