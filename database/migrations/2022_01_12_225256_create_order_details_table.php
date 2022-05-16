<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id'); //order->id
            $table->string('shirt_shirt_size')->nullable();
            $table->string('shirt_waist_size')->nullable();
            $table->string('shirt_shirt_detail')->nullable();
            $table->string('shirt_waist_detail')->nullable();
            $table->string('sell_date')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('sarong_waist_size')->nullable();
            $table->string('sarong_hip_size')->nullable();
            $table->string('sarong_long_size')->nullable();
            $table->string('sarong_waist_detail')->nullable();
            $table->string('sarong_hip_detail')->nullable();
            $table->string('sarong_long_detail')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
