<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\LocationServiceInterface;
use App\Repositories\LocationRepository;

class LocationService implements LocationServiceInterface
{
    private const EARTH_RADIUS = 6371000;

    public function __construct(
        public LocationRepository $locationRepository
    ) {}

    public function getLocationsByRadiusAndPoint(string $place, int $range): array
    {
        $allLocations = $this->locationRepository->getAllLocations();
        $point = $allLocations[$place];

        return $this->findLocationsInRadius($point['lat'], $point['lon'], $range, $allLocations);
    }

    private function findLocationsInRadius($targetLat, $targetLon, $radius, $locations): array
    {
        $result = [];

        foreach ($locations as $place => $location) {
            //TODO result can be in cache
            $distance = $this->haversineDistance($targetLat, $targetLon, $location['lat'], $location['lon']);

            if ($distance <= $radius) {
                $result[] = $place;
            }
        }

        return $result;
    }

    private function haversineDistance($lat1, $lon1, $lat2, $lon2): float
    {
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * self::EARTH_RADIUS;
    }

}
