<?php

// database/migrations/*create_queues_table.php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueuesTable extends Migration
{
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('email');
            $table->string('phone_number');
            $table->integer('queue_number')->nullable();
            $table->enum('status', ['pending', 'processing', 'skipped', 'completed'])->default('pending');
            $table->string('counter');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('queues');
    }
}


