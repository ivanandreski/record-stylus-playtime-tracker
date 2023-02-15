<?php

namespace App\Repository;

interface DiscogsRemoteDataSourceInterface {
    // TODO: add dependency injection
    public function getCollectionJson();

    public function parseJsonCollectionAndUpdateCache(array $jsonPages = []);
}