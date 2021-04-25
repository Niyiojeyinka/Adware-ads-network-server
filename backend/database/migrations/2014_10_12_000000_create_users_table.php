<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename')->nullable();
            $table->string('account_no');
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->string('recovery_token')->nullable();
            $table->integer('referral_id')->nullable();
            $table->integer('country_id')->references('id')->on('countries')->nullable();
            $table->integer('role_id')->references('id')->on('roles');
            $table->string('email')->unique();
            $table->enum('verify_status',['verified','unverified'])->default('unverified');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('pin')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
