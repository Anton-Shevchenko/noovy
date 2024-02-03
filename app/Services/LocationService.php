<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\LocationRepositoryInterface;
use App\Contracts\Services\LocationServiceInterface;

class LocationService implements LocationServiceInterface
{
    private const EARTH_RADIUS = 6371000;
    private const METERS_IN_KM = 1000;

    public function __construct(
        public LocationRepositoryInterface $locationRepository
    ) {}

    public function getLocationsByRadiusAndPoint(string $placeName, int $range): array
    {
        $allLocations = $this->locationRepository->getAllLocations();
        $point = $this->locationRepository->getLocationByName($placeName);

        return $this->findLocationsInRadius(
            $point->getLatitude(),
            $point->getLongitude(),
            $range * self::METERS_IN_KM,
            $allLocations
        );
    }

    private function findLocationsInRadius($targetLat, $targetLon, $radius, $locations): array
    {
        $result = [];

        foreach ($locations as $location) {
            //result can be in cache
            $distance = $this->haversineDistance(
                $targetLat,
                $targetLon,
                $location->getLatitude(),
                $location->getLongitude()
            );

            if ($distance < $radius) {
                $location->distance = $this->roundDistance($distance);
                $result[] = $location;
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

    private function roundDistance(float $distance): float
    {
        return round($distance / self::METERS_IN_KM, 3);
    }
}
