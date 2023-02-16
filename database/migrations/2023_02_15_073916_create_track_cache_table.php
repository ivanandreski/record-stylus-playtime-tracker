<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackCacheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks_cache', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('position');
            $table->string('name');
            $table->integer('duration_seconds');
            $table->bigInteger('album_cache_id');
            $table->foreign('album_cache_id')
                ->references('id')
                ->on('albums_cache')
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
        Schema::dropIfExists('tracks_cache');
    }
}
