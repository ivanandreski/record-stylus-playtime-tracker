<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaySessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_sessions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('playtime_seconds');
            $table->bigInteger('stylus_id');
            $table->foreign('stylus_id')
                ->references('id')
                ->on('styluses')
                ->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('play_sessions');
    }
}
