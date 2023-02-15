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

    public function __construct()
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
    }

    public function getCollectionJson()
    {
        $pages = [];

        $page = 1;
        while (true) {
            $response =  Http::get($this->finalUrl . "&page=$page");
            if ($response->status() == 404)
                break;

            $pages[] = $response->json();

            $page++;
        }
    }

    public function parseJsonCollectionAndUpdateCache(array $jsonPages = [])
    {
        $existingDiscogsIds = AlbumCache::select('album_cache.id')->get()->toArray();
        $remoteDiscogsIds = [];

        foreach($jsonPages as $jsonPage) {
            $decodedPage = json_decode($jsonPage);

            foreach($decodedPage->releases as $release) {
                $remoteDiscogsIds[] = $release->id;

                if(in_array($release->id, $existingDiscogsIds, true)) {
                    continue;
                }

                $albumCache = new AlbumCache();
                $albumCache->discogs_id = $release->id;
                $albumCache->discogs_resource_url = $release->basic_information->resource_url;
                $albumCache->title = $release->basic_information->title;
                $albumCache->artist_name = $release->artists[0]->name;
                $albumCache->release_year = $release->basic_information->year;
                $albumCache->duration_seconds = 0;
                $albumCache->in_collection = true;
                $albumCache->save();

                $resourceResponse =  Http::get($release->resource_url);
                $resource = json_decode($resourceResponse->json());
                foreach($resource->tracklist as $track) {
                    $trackCache = new TrackCache();
                    $trackCache->position = $track->position;
                    $trackCache->name = $track->title;
                    $durationSplit = explode(":", $track->duration);
                    $trackCache->duration_seconds = (int)$durationSplit[1] + ((int)$durationSplit[0] * 60);
                    $trackCache->album_cache_id = $albumCache->id;
                    $trackCache->save();
                }
            }
        }

        $toDeleteIds = [];
        foreach($existingDiscogsIds as $existingDiscogsId) {
            if(!in_array($existingDiscogsId, $remoteDiscogsIds)) {
                $toDeleteIds[] = $existingDiscogsId;
            }
        }

        AlbumCache::whereIn('discogs_id', $toDeleteIds)->delete();
    }
}
