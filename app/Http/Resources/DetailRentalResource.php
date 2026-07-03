<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailRentalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'rental_alat_id' => $this->rental_alat_id,
            'rental_alat' => new RentalAlatResource($this->whenLoaded('rentalAlat')),
            'alat_band_id' => $this->alat_band_id,
            'alat_band' => new AlatBandResource($this->whenLoaded('alatBand')),
            'jumlah' => $this->jumlah,
            'durasi' => $this->durasi,
            'subtotal' => $this->subtotal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
