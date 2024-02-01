<?php

namespace App\Contracts\Services;

interface LocationServiceInterface
{
    public function getLocationsByRadiusAndPoint(string $place, int $range): array;
}
