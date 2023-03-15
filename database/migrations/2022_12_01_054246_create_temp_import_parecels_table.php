<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempImportParecelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_import_parecels', function (Blueprint $table) {
            $table->id();
            $table->integer('temp_no')->nullable();
            $table->integer('invoiceNo')->nullable();
            $table->string('recipientName')->nullable();
            $table->double('productPrice')->nullable();
            $table->string('recipientPhone')->nullable();
            $table->string('alternative_mobile_no')->nullable();
            $table->tinyText('recipientAddress')->nullable();
            $table->double('productWeight')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('temp_import_parecels');
    }
}
