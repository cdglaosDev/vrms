<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('app_form_id');
            $table->integer('number');
            $table->integer('chip_number');
            $table->integer('car_number');
            $table->datetime('expire_date');
            $table->datetime('issue_date');
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
        Schema::dropIfExists('app_cards');
    }
}
