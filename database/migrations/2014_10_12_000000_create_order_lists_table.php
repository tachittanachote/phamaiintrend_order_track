<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number')->nullable();
            $table->string('order_date')->nullable();
            $table->string('facebook_name')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('note')->nullable();
            $table->string('parcel_number')->nullable();
            $table->string('quantity')->nullable();
            $table->string('amount')->nullable();
            $table->string('ship_price')->nullable();
            $table->string('total_price')->nullable();
            $table->string('receive_bank_account')->nullable();
            $table->string('transfer_amount')->nullable();
            $table->string('transfer_datetime')->nullable();
            $table->string('have_souvenir')->nullable();
            $table->string('souvenir')->nullable();
            $table->string('product_code')->nullable();
            $table->string('detail')->nullable();
            $table->string('comment')->nullable();
            $table->string('price')->nullable();
            $table->string('order_timestamp')->nullable();
            $table->integer('printed')->default(0);
            $table->integer('deliveried')->default(0);
            $table->integer('order_completed')->default(0);
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
        Schema::dropIfExists('order_lists');
    }
}
