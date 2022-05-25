<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppIllegalTrafficTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_illegal_traffic', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('license_plate_number');
            $table->string('accidence');
            $table->string('place');
            $table->datetime('date');
            $table->text('remark');
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
        Schema::dropIfExists('app_illegal_traffic');
    }
}
