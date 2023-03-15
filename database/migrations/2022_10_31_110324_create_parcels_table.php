<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->integer('invoiceNo')->length('25');
            $table->integer('merchantId')->length('191');
            $table->integer('paymentInvoice')->nullable();
            $table->integer('cod');
            $table->integer('merchantAmount');
            $table->integer('merchantDue');
            $table->integer('merchantPaid')->default('0');
            $table->string('recipientName')->length('55');
            $table->string('recipientAddress')->length('191');
            $table->integer('recipientPhone')->length('20');
            $table->text('note')->length('500')->nullable();
            $table->integer('deliveryCharge')->nullable();
            $table->integer('codCharge')->nullable();
            $table->integer('productPrice')->nullable();
            $table->integer('deliveryman')->nullable();
            $table->integer('agentId')->nullable();
            $table->integer('productWeight')->nullable();
            $table->string('trackingCode')->length('12');
            $table->integer('percelType')->nullable();
            $table->integer('helpNumber')->nullable();
            $table->string('reciveZone')->length('55')->nullable();
            $table->integer('orderType');
            $table->integer('codType');
            $table->tinyInteger('status');
            $table->string('status_description')->length('60');
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
        Schema::dropIfExists('parcels');
    }
}
