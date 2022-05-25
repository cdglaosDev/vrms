<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('book_number');
            $table->string('book_type');
            $table->string('book_vehicle_type');
            $table->string('book_license_plate_number');
            $table->string('book_vehicle_brand');
            $table->string('book_vehicle_model');
            $table->string('book_vehicle_color');
            $table->string('book_steering_wheel');
            $table->string('book_engine_brand');
            $table->string('book_no_cylinder');
            $table->string('book_cc');
            $table->string('book_engine_number');
            $table->string('book_chass_number');
            $table->string('book_vehicle_width');
            $table->string('book_vehicle_length');
            $table->string('book_vehicle_height');
            $table->integer('book_seat_number');
            $table->string('book_net_weight');
            $table->string('book_owner_name');
            $table->string('book_owner_last_name');
            $table->text('book_owner_address');
            $table->string('book_owner_district');
            $table->string('book_owner_phone');
            $table->string('book_owner_fax');
            $table->datetime('book_valid_date');
            $table->datetime('book_issue_date');
            $table->string('book_issue_place');
            $table->string('book_approve_officer_name');
            $table->datetime('book_extension_date');
            $table->text('book_addition_info');
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
        Schema::dropIfExists('app_books');
    }
}
