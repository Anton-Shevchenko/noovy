<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Repositories\LocationRepositoryInterface;
use App\Contracts\Services\LocationServiceInterface;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct(
        public LocationServiceInterface $locationService,
        public LocationRepositoryInterface $locationRepository,
    ) {}

    public function index()
    {
        return view("locations", ["locations" => array_keys($this->locationRepository->getAllLocations())]);
    }

    public function getlocationsInRadius(Request $request)
    {
        $this->validate($request, [
            'place' => 'required|string|max:255',
            'range' => 'required|integer|max:1000000'
        ]);

        return [
            "locations" => $this->locationService->getLocationsByRadiusAndPoint(
                $request->get("place"),
                intval($request->get("range"))
            )
        ];
    }
}
