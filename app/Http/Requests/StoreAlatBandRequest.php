<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlatBandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_alat_id' => 'required|exists:kategoris,id',
            'nama_alat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga_sewa' => 'required|integer|min:1',
            'kondisi' => 'required|string|in:Baik,Rusak,Maintenance',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'kategori_alat_id.required' => 'Kategori alat wajib dipilih.',
            'kategori_alat_id.exists' => 'Kategori alat tidak ditemukan.',
            
            'nama_alat.required' => 'Nama alat wajib diisi.',
            'nama_alat.string' => 'Nama alat harus berupa teks.',
            'nama_alat.max' => 'Nama alat maksimal 255 karakter.',
            
            'stok.required' => 'Stok alat wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka bulat.',
            'stok.min' => 'Stok minimal 0.',
            
            'harga_sewa.required' => 'Harga sewa wajib diisi.',
            'harga_sewa.integer' => 'Harga sewa harus berupa angka bulat.',
            'harga_sewa.min' => 'Harga sewa minimal Rp 1.',
            
            'kondisi.required' => 'Kondisi alat wajib diisi.',
            'kondisi.string' => 'Kondisi harus berupa teks.',
            'kondisi.in' => 'Kondisi harus Baik, Rusak, atau Maintenance.',
            
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
            'foto.max' => 'Ukuran gambar maksimal 5 MB.',
        ];
    }
}
