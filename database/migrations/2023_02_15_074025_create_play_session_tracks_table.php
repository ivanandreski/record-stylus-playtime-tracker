<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaySessionTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_session_tracks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('play_session_id');
            $table->foreign('play_session_id')
                ->references('id')
                ->on('play_sessions')
                ->onCascade('delete');
            $table->bigInteger('track_cache_id');
            $table->foreign('track_cache_id')
                ->references('id')
                ->on('tracks_cache')
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
        Schema::dropIfExists('play_session_tracks');
    }
}
