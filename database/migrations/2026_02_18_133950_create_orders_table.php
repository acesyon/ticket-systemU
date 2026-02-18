<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('orderID');
            $table->foreignId('userID')->constrained('users', 'id');
            $table->foreignId('ticketID')->constrained('tickets', 'ticketID');
            $table->integer('quantity');
            $table->timestamp('date_purchased')->useCurrent();
            $table->enum('status', ['pending', 'completed', 'cancelled', 'refunded'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};