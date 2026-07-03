<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PembayaranResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'rental_alat_id' => $this->rental_alat_id,
            'rental_alat' => new RentalAlatResource($this->whenLoaded('rentalAlat')),
            'tanggal_bayar' => $this->tanggal_bayar,
            'metode_bayar' => $this->metode_bayar,
            'total_bayar' => $this->total_bayar,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
