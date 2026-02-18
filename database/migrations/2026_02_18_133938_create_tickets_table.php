<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
    $table->id();

    $table->foreignId('event_id')
          ->constrained('events')
          ->onDelete('cascade');

    $table->enum('ticket_type', ['VIP', 'Regular', 'Early Bird', 'Student', 'Senior'])
          ->default('Regular');

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
