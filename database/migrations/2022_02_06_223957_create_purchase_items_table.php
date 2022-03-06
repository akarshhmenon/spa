<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purchase_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
             $table->string('product_name');
            $table->string('purchase_qty');
            $table->string('rate_per_qty');
            $table->string('total_tax_amount');
            $table->string('gst_percentage');
            $table->string('amount');
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
        Schema::dropIfExists('purchase_items');
    }
}
