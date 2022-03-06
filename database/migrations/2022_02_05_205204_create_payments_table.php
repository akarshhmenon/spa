<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('customer_id')->unsigned();
           $table->bigInteger('sale_id')->unsigned()->nullable();
            $table->bigInteger('booking_id')->unsigned()->nullable();
            $table->float('total_price');
            $table->float('total_discount')->default(0);
            $table->float('payable_amount');
            $table->string('date');
            $table->string('type'); //bank or cash
            $table->string('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
