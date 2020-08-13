<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table
                ->integer('user_id')
                ->references('id')
                ->on('users'); //owner
            $table->enum('type', ['text', 'banner']);
            $table->string('landing_url');
            $table->decimal('amount_per_view', 12, 2);
            $table->decimal('amount_per_click', 12, 2);
            $table
                ->enum('pay_model', ['cpc', 'cpm', 'cpc_cpm'])
                ->default('cpc_cpm');
            $table
                ->enum('status', ['active', 'inactive', 'suspended'])
                ->default('inactive');
            $table
                ->enum('approval_status', [
                    'approved',
                    'pending',
                    'disapproved',
                ])
                ->default('pending');
            $table->decimal('budget', 12, 2)->default(0.0);
            $table->decimal('balance', 12, 2)->default(0.0);
            $table->string('ref');
            $table->string('start_at');
            $table->string('expire_at');
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
        Schema::dropIfExists('campaigns');
    }
}