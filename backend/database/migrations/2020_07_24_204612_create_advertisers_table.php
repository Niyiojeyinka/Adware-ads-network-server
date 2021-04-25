<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisers', function (Blueprint $table) {
            $table->id();
            $table
                ->integer('user_id')
                ->references('id')
                ->on('users');
            $table->decimal('account_bal', 12, 2)->default(0.0);
            $table
                ->enum('status', [
                    'pending',
                    'approved',
                    'disapproved',
                    'deactivated',
                ])
                ->default('approved');
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
        Schema::dropIfExists('advertisers');
    }
}