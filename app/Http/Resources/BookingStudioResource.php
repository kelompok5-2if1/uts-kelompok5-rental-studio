<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingStudioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pelanggan_id' => $this->pelanggan_id,
            'pelanggan' => new PelangganResource($this->whenLoaded('pelanggan')),
            'studio_id' => $this->studio_id,
            'studio' => new StudioResource($this->whenLoaded('studio')),
            'tanggal_booking' => $this->tanggal_booking,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'total_harga' => $this->total_harga,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
