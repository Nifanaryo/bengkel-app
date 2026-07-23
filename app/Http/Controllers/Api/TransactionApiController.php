<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Http\Resources\TransactionResource;

class TransactionApiController extends Controller
{
    public function index()
    {
        return TransactionResource::collection(
            Transaction::with(['customer', 'vehicle'])->latest()->get()
        );
    }
}