<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_form_id');
            $table->integer('doc_type_id');
            $table->string('filename');
            $table->string('link');
            $table->datetime('date');
            $table->datetime('deleted_at');
            $table->foreign('app_form_id')->references('id')->on('app_forms')->onDelete('cascade');
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
        Schema::dropIfExists('app_documents');
    }
}
