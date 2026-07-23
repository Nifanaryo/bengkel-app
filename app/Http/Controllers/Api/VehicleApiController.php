<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Http\Resources\VehicleResource;

class VehicleApiController extends Controller
{
    public function index()
    {
        return VehicleResource::collection(Vehicle::with('customer')->latest()->get());
    }
}