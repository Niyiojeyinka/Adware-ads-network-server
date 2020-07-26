<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_spaces', function (Blueprint $table) {
            $table->id();
            $table
                ->integer('campaign_id')
                ->reference('id')
                ->on('campaigns');
            $table->string('name');
            $table
                ->integer('user_id')
                ->references('id')
                ->on('users');
            $table->string('ref');
            $table
                ->integer('inventory_id')
                ->references('id')
                ->on('inventories');
            $table
                ->enum('approval_status', [
                    'approved',
                    'pending',
                    'disapproved',
                ])
                ->default('pending');
            $table
                ->enum('status', ['active', 'inactive', 'suspended'])
                ->default('inactive');

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
        Schema::dropIfExists('ad_spaces');
    }
}