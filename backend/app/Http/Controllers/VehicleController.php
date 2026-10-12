<?php

namespace App\Http\Controllers;

use App\Services\GlincheClient;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    private $glincheClient;

    public function __construct(
        GlincheClient $glincheClient
    ) {
        $this->glincheClient = $glincheClient;
    }

    public function index(Request $request)
    {
        $vehicles = $this->glincheClient->detailedVehicles();

        $manufacturer = $request->query('manufacturer');

        if ($manufacturer) {
            $vehicles = array_filter(
                $vehicles,
                fn ($vehicle) =>
                    isset($vehicle['manufacturer'])
                    && strcasecmp(
                        $vehicle['manufacturer'],
                        $manufacturer
                    ) === 0
            );

            $vehicles = array_values($vehicles);
        }

        return response()->json($vehicles);
    }

    public function brands()
    {
        $vehicles = $this->glincheClient->detailedVehicles();

        $manufacturers = array_filter(
            array_column($vehicles, 'manufacturer')
        );

        $manufacturers = array_values(
            array_unique($manufacturers)
        );

        sort($manufacturers);

        return response()->json($manufacturers);
    }
}
