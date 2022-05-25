<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppRoadTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_road_taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('app_form_id');
            $table->integer('amount');
            $table->string('currency');
            $table->string('file');
            $table->datetime('date');
            $table->text('remark');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('app_road_taxes');
    }
}
