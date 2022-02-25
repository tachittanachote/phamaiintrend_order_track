<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_sizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unique();
            $table->string('shirt_shirt_size');
            $table->string('shirt_waist_size');
            $table->string('sarong_waist_size');
            $table->string('sarong_hip_size');
            $table->string('sarong_long_size');
            $table->string('customer_name');
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
        Schema::dropIfExists('customer_sizes');
    }
}
