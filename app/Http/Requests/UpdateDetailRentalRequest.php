<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailRentalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rental_alat_id' => 'required|exists:rental_alats,id',
            'alat_band_id' => 'required|exists:alat_bands,id',
            'jumlah' => 'required|integer|min:1',
            'durasi' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0.01',
        ];
    }

    public function messages(): array
    {
        return [
            'rental_alat_id.required' => 'Rental alat wajib dipilih.',
            'rental_alat_id.exists' => 'Rental alat tidak ditemukan.',
            
            'alat_band_id.required' => 'Alat band wajib dipilih.',
            'alat_band_id.exists' => 'Alat band tidak ditemukan.',
            
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka bulat.',
            'jumlah.min' => 'Jumlah minimal 1.',
            
            'durasi.required' => 'Durasi wajib diisi.',
            'durasi.integer' => 'Durasi harus berupa angka bulat.',
            'durasi.min' => 'Durasi minimal 1 jam.',
            
            'subtotal.required' => 'Subtotal wajib diisi.',
            'subtotal.numeric' => 'Subtotal harus berupa angka.',
            'subtotal.min' => 'Subtotal minimal Rp 0,01.',
        ];
    }
}
