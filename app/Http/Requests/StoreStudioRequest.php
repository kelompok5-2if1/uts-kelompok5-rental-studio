<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_studio' => 'required|string|max:255|unique:studios',
            'kapasitas' => 'required|integer|min:1',
            'harga_per_jam' => 'required|numeric|min:0.01',
            'status' => 'required|string|in:Tersedia,Maintenance',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_studio.required' => 'Nama studio wajib diisi.',
            'nama_studio.string' => 'Nama studio harus berupa teks.',
            'nama_studio.max' => 'Nama studio maksimal 255 karakter.',
            'nama_studio.unique' => 'Nama studio sudah terdaftar.',
            
            'kapasitas.required' => 'Kapasitas studio wajib diisi.',
            'kapasitas.integer' => 'Kapasitas harus berupa angka bulat.',
            'kapasitas.min' => 'Kapasitas minimal 1 orang.',
            
            'harga_per_jam.required' => 'Harga per jam wajib diisi.',
            'harga_per_jam.numeric' => 'Harga harus berupa angka.',
            'harga_per_jam.min' => 'Harga minimal Rp 0,01.',
            
            'status.required' => 'Status wajib diisi.',
            'status.string' => 'Status harus berupa teks.',
            'status.in' => 'Status harus Tersedia atau Maintenance.',
            
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
            'foto.max' => 'Ukuran gambar maksimal 5 MB.',
        ];
    }
}
