<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentalAlatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pelanggan_id' => $this->pelanggan_id,
            'pelanggan' => new PelangganResource($this->whenLoaded('pelanggan')),
            'alat_band_id' => $this->alat_band_id,
            'alat_band' => new AlatBandResource($this->whenLoaded('alatBand')),
            'tanggal_sewa' => $this->tanggal_sewa,
            'tanggal_kembali' => $this->tanggal_kembali,
            'jumlah' => $this->jumlah,
            'total_harga' => $this->total_harga,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
