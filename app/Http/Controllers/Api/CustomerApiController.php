<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;

class CustomerApiController extends Controller
{
    public function index()
    {
        return CustomerResource::collection(Customer::latest()->get());
    }
}