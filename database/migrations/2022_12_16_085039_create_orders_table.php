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
            $table->string('order_id')->primary();
            $table->foreignId('user_id');
            $table->string('payment_id')->foreignId();
            $table->string('seat_id')->foreignId();
            $table->string('theater');
            $table->string('date');
            $table->string('time');
            $table->string('id_movie');
            $table->string('movie');
            $table->string('jml_tiket');
            $table->string('tiket_price');
            $table->string('addon');
            $table->string('addon_price');
            $table->string('total_price');
            $table->string('snap_token');
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
        Schema::dropIfExists('orders');
    }
};
