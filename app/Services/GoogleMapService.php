<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\GoogleMapServiceInterface;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class GoogleMapService implements GoogleMapServiceInterface
{
    public static function getPhotoPlaceByTextQuery(string $place): ?string
    {
        $client = new Client();
        try {
            //env url to constructor
            $response = $client->get(sprintf(env("GOOGLE_MAP_PHOTO_URL"), $place));
            $responseContent = json_decode($response->getBody()->getContents());
            $candidate = $responseContent?->candidates[0] ?? null;

            return $candidate && isset($candidate->photos) ? $candidate->photos[0]?->photo_reference : null;
        } catch (\Exception $exception) {
            Log::error('Google map error: '.$exception->getMessage());
        }
    }
}
