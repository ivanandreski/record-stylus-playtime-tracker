<?php

namespace App\Repository;

use App\Models\AlbumCache;
use App\Models\TrackCache;

class AlbumCacheRepository implements AlbumCacheRepositoryInterface
{
    public function getExistingDiscordIds(): array
    {
        return AlbumCache::select('albums_cache.discogs_id')
            ->get()
            ->map(function ($item, $key) {
                return $item->discogs_id;
            })->toArray();
    }

    public function deleteAllNonExistingAlbums($existingDiscogsIds, $remoteDiscogsIds): void {
        $toDeleteIds = [];
        foreach ($existingDiscogsIds as $existingDiscogsId) {
            if (!in_array($existingDiscogsId, $remoteDiscogsIds)) {
                $toDeleteIds[] = $existingDiscogsId;
            }
        }

        AlbumCache::whereIn('discogs_id', $toDeleteIds)->delete();
    }

    public function tracksExistForAlbumCache($albumId): bool
    {
        return TrackCache::where('album_cache_id', '=', $albumId)->count() > 0;
    }
}
