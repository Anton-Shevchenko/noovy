<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Services\UploadServiceInterface;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __construct(
        public UploadServiceInterface $uploadService
    ) {}

    public function upload(Request $request)
    {
        $this->validate($request, [
            'csvFile' => 'required|mimes:csv|max:10240',
        ]);

        $file = $request->file('csvFile');

        return $this->uploadService->uploadCSVToDB($file);
    }
}
