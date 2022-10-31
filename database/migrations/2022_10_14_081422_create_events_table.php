<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->foreignId('user_id');
            $table->string('assignedBy')->nullable();
            $table->dateTime('assignementDate')->nullable();
            $table->text('description')->nullable();
            $table->string('siteweb');
            $table->string('phone_client');
            $table->string('name_client');
            $table->string('status');
            $table->string('priority');
            $table->string('color')->nullable();
            $table->string('textColor')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
