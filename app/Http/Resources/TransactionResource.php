<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'customer_id' => $this->customer_id,
            'vehicle_id'  => $this->vehicle_id,
            'user_id'     => $this->user_id,
            'keluhan'     => $this->keluhan,
            'biaya_total' => $this->biaya_total,
            'status'      => $this->status,
            'tanggal'     => $this->tanggal,
            'pelanggan'   => new CustomerResource($this->whenLoaded('customer')),
            'kendaraan'   => new VehicleResource($this->whenLoaded('vehicle')),
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}