<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIllegalTrafficTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('illegal_traffic', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('license_no');
            $table->string('division_no');
            $table->string('place');
            $table->string('offender_name');
            $table->string('officer_name');
            $table->string('type');
            $table->string('brand');
            $table->string('model');
            $table->string('color');
            $table->date('date');
            $table->boolean('status')->default(1);    
            $table->text('remark');
            $table->datetime('deleted_at');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('illegal_traffic');
    }
}
