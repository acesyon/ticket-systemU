<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('eventID');
            $table->string('event_name');
            $table->text('description');
            $table->string('location');
            $table->date('eventDate');
            $table->time('eventTime');
            $table->enum('status', ['upcoming', 'ongoing', 'cancelled', 'completed'])->default('upcoming');
            $table->foreignId('created_by')->constrained('users', 'id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};