<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumCacheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_cache', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('discogs_id')->unique();
            $table->string('discogs_resource_url')->unique();
            $table->string('title');
            $table->string('artist_name');
            $table->integer('release_year');
            $table->integer('duration_seconds');
            $table->boolean('in_collection');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_cache');
    }
}
