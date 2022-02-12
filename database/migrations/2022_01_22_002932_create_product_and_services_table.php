<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAndServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_and_services', function (Blueprint $table) {
            $table->id();



            $table->string('name');
            $table->string('type');
            $table->string('batch_no')->nullable();
            $table->string('hsn_code')->nullable();
            $table->string('mfg_date')->nullable();
            $table->string('exp_date')->nullable();
            $table->string('gst')->nullable();
            $table->text('description')->nullable();
            $table->float('mrp')->nullable();
            $table->string('rack_number')->nullable();
            $table->string('time')->nullable();
            $table->string('quantity');
            $table->string('opening_quantity');
            $table->bigInteger('categories_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
$table->string('add_to_home')->default(0);

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
        Schema::dropIfExists('product_and_services');
    }
}
