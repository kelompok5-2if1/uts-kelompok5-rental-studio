<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlatBandResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_alat' => $this->nama_alat,
            'kategori_id' => $this->kategori_id,
            'kategori' => new KategoriResource($this->whenLoaded('kategori')),
            'stok' => $this->stok,
            'harga_sewa' => $this->harga_sewa,
            'kondisi' => $this->kondisi,
            'foto' => $this->foto ? asset('storage/' . $this->foto) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
