<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->integer('user_id');
            $table->string('email')->nullable();
            $table->string('user_first_name');
            $table->string('user_last_name');
            $table->integer('city_id');
            $table->integer('district_id');
            $table->integer('ward_id');
            $table->string('address');
            $table->string('phone_number');
            $table->string('note')->nullable();
            $table->integer('amount');
            $table->tinyInteger('status')->index("idx_orders_status");
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
        Schema::drop('orders');
    }
};