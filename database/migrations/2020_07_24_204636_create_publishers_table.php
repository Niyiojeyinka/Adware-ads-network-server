<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table
                ->integer('user_id')
                ->references('id')
                ->on('users');
            $table->decimal('account_bal', 12, 2)->default(0.0);
            $table->decimal('pending_bal', 12, 2)->default(0.0);
            $table->decimal('total_earned', 12, 2)->default(0.0);
            $table->string('url')->nullable();
            $table
                ->enum('status', [
                    'pending',
                    'approved',
                    'disapproved',
                    'deactivated',
                ])
                ->default('pending');
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
        Schema::dropIfExists('publishers');
    }
}