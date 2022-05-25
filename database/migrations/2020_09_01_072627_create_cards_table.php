<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('licence_no',10);
            $table->string('province_no', 10);
            $table->string('division_no', 10);
            $table->string('province' ,50);
            $table->string('district', 50);
            $table->string('village', 100);
            $table->string('name', 50);
            $table->string('engine_no', 20);
            $table->string('chassis_no', 20);
            $table->string('vehicle_type', 50);
            $table->string('brand', 50);
            $table->string('model', 50);
            $table->string('color', 20);
            $table->string('issue_date');
            $table->string('expire_date');
            $table->string('card_no', 10);
            $table->string('purpose')->nullable();
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
        Schema::dropIfExists('cards');
    }
}
