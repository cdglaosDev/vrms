<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id');
            $table->datetime('date_req');
            $table->integer('application_type_id');
            $table->integer('app_license_type_id');
            $table->string('ministry_license');
            $table->integer('tax_office_id');
            $table->string('department_license');
            $table->datetime('detail_date_approve');
            $table->datetime('date_expire');
            $table->datetime('extra_time');
            $table->integer('app_purpose_id');
            $table->integer('app_number');
            $table->integer('app_status_id');
            $table->text('note');
            $table->text('comment');
            $table->text('qrcode');
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
        Schema::dropIfExists('app_forms');
    }
}
