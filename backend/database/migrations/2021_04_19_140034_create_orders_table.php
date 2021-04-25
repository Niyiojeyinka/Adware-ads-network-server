<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id')->references('id')->on('users');
            $table->integer('buyer_id')->references('id')->on('users');
            $table->integer('offer_id')->references('id')->on('offers');
            $table->integer('amount');
            $table->integer('rate');
            $table->enum('seller_status',['approved','disputed','pending'])->default("pending");
            $table->enum('buyer_status',['approved','disputed','pending'])->default("pending");
            $table->enum('status',['pending','successful','dispute','canceled'])->default("pending");
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
        Schema::dropIfExists('orders');
    }
}
