<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('sale_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->string('product_name');
            $table->string('quantity');

            $table->float('rate');
           
            $table->float('total_rate');
            $table->float('taxable_value');
            $table->float('gst');
            $table->float('cgst');
            $table->float('sgst');
            $table->float('cess');
            
            
            $table->float('net_total');
         
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
        Schema::dropIfExists('sale_items');
    }
}
