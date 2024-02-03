<?php

namespace App\Contracts\Repositories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

interface LocationRepositoryInterface
{
    public function getAllLocations(): Collection;

    public function getLocationByName(string $name): Location;
}
