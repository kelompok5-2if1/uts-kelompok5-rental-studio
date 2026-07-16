<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePembayaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jenis_transaksi' => 'required|string|in:Booking Studio,Rental Alat',
            'booking_studio_id' => 'nullable|exists:booking_studios,id',
            'rental_alat_id' => 'nullable|exists:rental_alats,id',
            'tanggal_bayar' => 'nullable|date',
            'metode_bayar' => 'required|string|in:Cash,Transfer,QRIS,Debit',
            'nominal_dibayar' => 'required|numeric|min:0.01',
            'status' => 'required|string|in:Pending,Lunas',
        ];
    }

    public function messages(): array
    {
        return [
            'rental_alat_id.required' => 'Rental alat wajib dipilih.',
            'rental_alat_id.exists' => 'Rental alat tidak ditemukan.',
            
            'tanggal_bayar.required' => 'Tanggal bayar wajib diisi.',
            'tanggal_bayar.date' => 'Format tanggal bayar tidak valid.',
            
            'metode_bayar.required' => 'Metode bayar wajib dipilih.',
            'metode_bayar.string' => 'Metode bayar harus berupa teks.',
            'metode_bayar.in' => 'Metode bayar harus Cash, Transfer, atau CC.',
            
            'total_bayar.required' => 'Total bayar wajib diisi.',
            'total_bayar.numeric' => 'Total bayar harus berupa angka.',
            'total_bayar.min' => 'Total bayar minimal Rp 0,01.',
            
            'status.required' => 'Status wajib diisi.',
            'status.string' => 'Status harus berupa teks.',
            'status.in' => 'Status harus Pending atau Lunas.',
        ];
    }
}
