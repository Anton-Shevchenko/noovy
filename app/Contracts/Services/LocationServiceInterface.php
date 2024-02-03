<?php

namespace App\Contracts\Services;

interface LocationServiceInterface
{
    public function getLocationsByRadiusAndPoint(string $placeName, int $range): array;
}
