<?php

namespace App\Repository;

interface AlbumCacheRepositoryInterface {
    public function getExistingDiscordIds(): array;

    public function deleteAllNonExistingAlbums($existingDiscogsIds, $remoteDiscogsIds): void;

    public function tracksExistForAlbumCache($albumId): bool;
}