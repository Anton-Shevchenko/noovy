<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Services\LocationServiceInterface;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct(
        public LocationServiceInterface $locationService,
        public LocationRepository $locationRepository,
    ) {}

    public function index()
    {
        return view("locations", ["locations" => array_keys($this->locationRepository->getAllLocations())]);
    }

    public function getlocationsInradius(Request $request)
    {
        //TODO validation
        return [
            "locations" => $this->locationService->getLocationsByRadiusAndPoint(
                $request->get("place"),
                intval($request->get("range"))
            )
        ];
    }
}
