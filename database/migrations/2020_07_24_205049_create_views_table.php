<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table
                ->integer('campaign_id')
                ->references('id')
                ->on('canpaigns');
            $table
                ->integer('ad_space_id')
                ->references('id')
                ->on('ad_spaces');
            $table
                ->integer('country_id')
                ->nullable()
                ->references('id')
                ->on('countries');
            $table
                ->integer('browser_id')
                ->nullable()
                ->references('id')
                ->on('browsers');
            $table
                ->integer('device_type_id')
                ->nullable()
                ->references('id')
                ->on('device_types');
            $table
                ->integer('platform_id')
                ->nullable()
                ->references('id')
                ->on('platforms');
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
        Schema::dropIfExists('views');
    }
}