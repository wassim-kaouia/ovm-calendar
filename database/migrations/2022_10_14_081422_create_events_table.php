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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('assignedBy')->nullable();
            $table->dateTime('assignementDate')->nullable();
            $table->text('description')->nullable();
            $table->string('siteweb')->nullable();
            $table->string('phone_client')->nullable();
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
