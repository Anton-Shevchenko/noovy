<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use App\Services\UploadService;

class LocationRepository
{
    const DEFAULT_PATH = "public/". UploadService::DEFAULT_FOLDER ."/";
    private const FILE_PATH = self::DEFAULT_PATH . UploadService::DEFAULT_FILE_NAME;
    private const DEFAULT_LENGTH = 1000;

    public function getAllLocations(): array
    {
        $data = [];
        $exists = Storage::exists(self::FILE_PATH);

        if ($exists && ($handle = fopen(Storage::path(self::FILE_PATH), 'r')) !== false) {
            while (($row = fgetcsv($handle, self::DEFAULT_LENGTH, ',')) !== false) {
                $name = $row[0];
                //TODO add validation
                $coordinates = explode(",", $row[1]);

                if (count($coordinates) != 2) {
                    continue;
                }

                $data[$name] = ['lat' => floatval($coordinates[0]), "lon" => floatval($coordinates[1])];
            }

            fclose($handle);
        }

        return $data;
    }
}
