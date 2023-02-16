<?php

namespace App\Repository;

use App\Models\AlbumCache;
use App\Models\TrackCache;
use Illuminate\Support\Facades\Http;

class DiscogsRemoteDataSource implements DiscogsRemoteDataSourceInterface
{

    private $discogsApiUrl;
    private $discogsUsername;
    private $finalUrl;
    private $t;

    private AlbumCacheRepositoryInterface $albumCacheRepository;

    public function __construct(AlbumCacheRepositoryInterface $albumCacheRepository)
    {
        $this->t = "CnBHsGrEzRxVKNRVUtvhOZtsfcbHZyBzDhYCbXbm";
        $this->discogsApiUrl = "https://api.discogs.com/";
        $this->discogsUsername = "anzurakizz";
        $this->finalUrl = $this->discogsApiUrl
            . "users/"
            . $this->discogsUsername
            . "/collection/folders/0/releases"
            . "?sort_order=asc"
            . "&sort=artist"
            . "&per_page=100"
            . "&token=" . $this->t;

        $this->albumCacheRepository = $albumCacheRepository;
    }

    public function getCollectionJson()
    {
        $pages = [];

        $page = 1;
        while (true) {
            $response =  Http::get($this->finalUrl . "&page=$page");
            if ($response->status() == 404)
                break;

            $pages[] = $response->body();

            $page++;
        }

        return $pages;
    }

    public function parseJsonCollectionAndUpdateCache(array $jsonPages = [])
    {
        $existingDiscogsIds = $this->albumCacheRepository->getExistingDiscogsIds();
        $remoteDiscogsIds = [];

        foreach ($jsonPages as $jsonPage) {
            $decodedPage = json_decode($jsonPage);

            foreach ($decodedPage->releases as $release) {
                $remoteDiscogsIds[] = $release->id;
                if (in_array($release->id, $existingDiscogsIds)) {
                    continue;
                }

                $albumCache = new AlbumCache();
                $albumCache->discogs_id = $release->id;
                $albumCache->discogs_resource_url = $release->basic_information->resource_url;
                $albumCache->image_url = $release->basic_information->cover_image;
                $albumCache->title = $release->basic_information->title;
                $albumCache->artist_name = $release->basic_information->artists[0]->name;
                $albumCache->release_year = $release->basic_information->year;
                $albumCache->duration_seconds = 0;
                $albumCache->in_collection = true;
                $albumCache->save();
            }
        }

        if (count($jsonPages) > 0)
            $this->albumCacheRepository->deleteAllNonExistingAlbums($existingDiscogsIds, $remoteDiscogsIds);
    }

    public function updateTracksForAlbum(AlbumCache $album)
    {
        $totalDuration = 0;
        $resourceResponse =  Http::get($album->discogs_resource_url);
        $resource = json_decode($resourceResponse->body());
        foreach ($resource->tracklist as $track) {
            $trackCache = new TrackCache();
            $trackCache->position = $track->position;
            $trackCache->name = $track->title;
            if (!str_contains($track->duration, ":"))
                $trackCache->duration_seconds = 0;
            else {
                $durationSplit = explode(":", $track->duration);
                $trackCache->duration_seconds = (int)$durationSplit[1] + ((int)$durationSplit[0] * 60);
                $totalDuration += $trackCache->duration_seconds;
            }
            $trackCache->album_cache_id = $album->id;
            $trackCache->save();
        }

        $album->duration_seconds = $totalDuration == 0
            ? 2400
            : $totalDuration;
        $album->save();
    }
}
