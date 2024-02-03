<?php

namespace App\Repositories;

use App\Contracts\Repositories\LocationRepositoryInterface;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository extends BaseRepository implements LocationRepositoryInterface
{
    public function getAllLocations(): Collection
    {
       return Location::all();
    }

    public function getLocationByName(string $name): Location
    {
        return Location::where('name', $name)->first();
    }
}
