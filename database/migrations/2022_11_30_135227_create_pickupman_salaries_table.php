<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupmanSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickupman_salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('pickupman_id')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->double('total_paid')->nullable();
            $table->double('previous_due')->nullable();
            $table->double('comission')->nullable();
            $table->double('bonus')->nullable();
            $table->double('deduction')->nullable();
            $table->double('arrear')->nullable();
            $table->double('net_payable')->nullable();
            $table->bigInteger('boucher')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('pickupman_salaries');
    }
}
