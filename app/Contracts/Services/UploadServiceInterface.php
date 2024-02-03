<?php

namespace App\Contracts\Services;

use Illuminate\Http\UploadedFile;

interface UploadServiceInterface
{
    public function uploadCSVToDB(UploadedFile $file): bool;
}
