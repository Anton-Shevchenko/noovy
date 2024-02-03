<?php

namespace App\Contracts\Services;

interface GoogleMapServiceInterface
{
    public static function getPhotoPlaceByTextQuery(string $place): ?string;
}
