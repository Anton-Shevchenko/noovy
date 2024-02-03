<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\LocationRepositoryInterface;
use App\Contracts\Services\GoogleMapServiceInterface;
use App\Contracts\Services\UploadServiceInterface;
use App\Jobs\FetchPhotos;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class UploadLocationService implements UploadServiceInterface
{
    private const DEFAULT_LENGTH = 1000;

    public function __construct(
        public LocationRepositoryInterface $locationRepository,
        public GoogleMapServiceInterface $googleMapService,
    ) {}

    public function uploadCSVToDB(UploadedFile $file): bool
    {
        $path = $file->path();

        if (!file_exists($path)) {
            //log error
            return false;
        }

        $collection = $this->getLocationsFromCSVFile($path);

        $collection->map(function ($location) {
            $location->save();
            dispatch(new FetchPhotos($location->getName()));
        });

        //TODO list to view
        return true;
    }

    private function getLocationsFromCSVFile(string $path): Collection
    {
        $collection = Collection::empty();
        try {
            if (($handle = fopen($path, 'r')) !== false) {
                while (($row = fgetcsv($handle, self::DEFAULT_LENGTH, ',')) !== false) {
                    $coordinates = explode(",", $row[1]);
                    if (count($coordinates) != 2) {
                        // log invalid
                        continue;
                    }

                    //TODO add validation
                    $location = new Location;
                    $location->setName($row[0]);
                    $location->setLatitude(floatval($coordinates[0]));
                    $location->setLongitude(floatval($coordinates[1]));

                    $collection->add($location);
                }

                fclose($handle);
            }

            return $collection;
        } catch (\Exception $exception) {
            //log error
        }
    }
}
