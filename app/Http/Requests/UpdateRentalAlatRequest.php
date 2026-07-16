<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRentalAlatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'alat_band_id' => 'required|exists:alat_bands,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|string|in:Dipinjam,Dikembalikan',
        ];
    }

    public function messages(): array
    {
        return [
            'pelanggan_id.required' => 'Pelanggan wajib dipilih.',
            'pelanggan_id.exists' => 'Pelanggan tidak ditemukan.',
            
            'alat_band_id.required' => 'Alat band wajib dipilih.',
            'alat_band_id.exists' => 'Alat band tidak ditemukan.',
            
            'tanggal_sewa.required' => 'Tanggal sewa wajib diisi.',
            'tanggal_sewa.date' => 'Format tanggal sewa tidak valid.',
            
            'tanggal_kembali.required' => 'Tanggal kembali wajib diisi.',
            'tanggal_kembali.date' => 'Format tanggal kembali tidak valid.',
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali harus sama atau setelah tanggal sewa.',
            
            'jumlah.required' => 'Jumlah alat wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka bulat.',
            'jumlah.min' => 'Jumlah minimal 1 unit.',
            
            'total_harga.required' => 'Total harga wajib diisi.',
            'total_harga.integer' => 'Total harga harus berupa angka bulat.',
            'total_harga.min' => 'Total harga minimal Rp 1.',
            
            'status.required' => 'Status wajib diisi.',
            'status.string' => 'Status harus berupa teks.',
            'status.in' => 'Status harus Dipinjam atau Dikembalikan.',
        ];
    }
}
