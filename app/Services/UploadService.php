<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\LocationRepositoryInterface;
use App\Contracts\Services\UploadServiceInterface;
use Illuminate\Http\UploadedFile;

class UploadService implements UploadServiceInterface
{
    public const DEFAULT_OPTION = 'public';
    public const DEFAULT_FILE_NAME = 'locations.csv';
    public const DEFAULT_FOLDER = 'uploads';

    public function uploadCSV(UploadedFile $file): bool
    {
        try {
            $file->storeAs(self::DEFAULT_FOLDER, self::DEFAULT_FILE_NAME, self::DEFAULT_OPTION);

            return true;
        } catch (\Exception $exception) {
            // log
            return false;
        }
    }
}
