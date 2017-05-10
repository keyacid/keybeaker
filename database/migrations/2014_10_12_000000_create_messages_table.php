<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->char('sender_key',44);
            $table->char('receiver_key',44);
            $table->longText('content');
            $table->char('signature',88);
            $table->enum('sender_status',['sent','deleted'])->default('sent');
            $table->enum('receiver_status',['received','read','deleted'])->default('received');
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
        Schema::dropIfExists('messasges');
    }
}
