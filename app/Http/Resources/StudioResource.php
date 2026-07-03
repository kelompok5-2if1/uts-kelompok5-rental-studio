<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_studio' => $this->nama_studio,
            'kapasitas' => $this->kapasitas,
            'harga_per_jam' => $this->harga_per_jam,
            'status' => $this->status,
            'foto' => $this->foto ? asset('storage/' . $this->foto) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
