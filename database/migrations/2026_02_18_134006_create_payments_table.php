<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('paymentID');
            $table->foreignId('orderID')->constrained('orders', 'orderID');
            $table->enum('payment_method', ['cash', 'gcash', 'credit_card', 'paypal'])->default('cash');
            $table->decimal('payment', 10, 2);
            $table->timestamp('date_paid')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};