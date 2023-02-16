<?php

namespace App\Repository;

use App\Models\AlbumCache;

interface DiscogsRemoteDataSourceInterface {
    public function getCollectionJson();

    public function parseJsonCollectionAndUpdateCache(array $jsonPages = []);

    public function updateTracksForAlbum(AlbumCache $album);
}