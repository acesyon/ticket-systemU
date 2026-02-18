<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticketID');
            $table->foreignId('eventID')->constrained('events', 'eventID');
            $table->enum('ticketType', ['VIP', 'Regular', 'Early Bird', 'Student', 'Senior'])->default('Regular');
            $table->decimal('price', 10, 2);
            $table->integer('quantity_available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};