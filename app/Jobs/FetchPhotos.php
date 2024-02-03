<?php

namespace App\Jobs;

use App\Models\Location;
use App\Services\GoogleMapService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class FetchPhotos extends Job
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $locationName,
    ) {}

    public function handle()
    {
        $location = Location::where('name', $this->locationName)->get()[0];
        $location->setThumb(GoogleMapService::getPhotoPlaceByTextQuery($location->getName()));
        $location->save();
    }
}
