<?php

namespace App\Jobs;

use App\Models\Location;
use App\Services\GoogleMapService;
use Illuminate\Support\Facades\Log;

class FetchPhotos extends Job
{
    public function __construct(
        public string $locationName,
    ) {}

    public function handle()
    {
        try {
            $location = Location::where('name', $this->locationName)->get()[0];
            $location->setThumb(GoogleMapService::getPhotoPlaceByTextQuery($location->getName()));
            $location->save();
        } catch (\Exception $e) {
            Log::error('Job failed: ' . $e->getMessage());
        }
    }
}
