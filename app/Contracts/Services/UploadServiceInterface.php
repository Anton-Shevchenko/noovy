<?php

namespace App\Contracts\Services;

use Illuminate\Http\UploadedFile;

interface UploadServiceInterface
{
    public function uploadCSV(UploadedFile $file): bool;
}
