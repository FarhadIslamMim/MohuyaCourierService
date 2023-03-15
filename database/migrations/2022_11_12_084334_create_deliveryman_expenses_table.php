<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliverymanExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveryman_expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('deliveryman_id')->nullable();
            $table->double('oil_cost')->default(0.00)->nullable();
            $table->double('other_costs')->nullable();
            $table->date('date')->nullable();
            $table->integer('authorized_by')->nullable();
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
        Schema::dropIfExists('deliveryman_expenses');
    }
}
