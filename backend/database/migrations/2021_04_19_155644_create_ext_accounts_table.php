<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('bank_code');
            $table->string('user_bank_name');
            $table->string('user_account_no');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('provider_id')->references('id')->on('ext_account_providers');
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
        Schema::dropIfExists('ext_accounts');
    }
}
