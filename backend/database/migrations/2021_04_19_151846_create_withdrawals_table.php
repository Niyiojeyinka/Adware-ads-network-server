<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('amount')->default(0);
            $table->string('reference_no');
            $table->string('bank_id')->references('id')->on('banks')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('note')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('value1')->nullable();
            $table->string('value2')->nullable();
            $table->enum('type',['bank'])->default('bank');
            $table->enum('status',['successful','failed','pending'])->default('pending');
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
        Schema::dropIfExists('withdrawals');
    }
}
