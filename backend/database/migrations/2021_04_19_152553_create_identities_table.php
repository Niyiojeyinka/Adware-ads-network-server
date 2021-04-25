<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identities', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('type_id')->references('id')->on('identity_types');
            $table->integer('front_id')->references('id')->on('media');
            $table->integer('back_id')->references('id')->on('media');
            $table->string('idno');
            $table->string("name");
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->enum('status',['pending','approved','disapproved'])->default('pending');
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
        Schema::dropIfExists('identities');
    }
}
