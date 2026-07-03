<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanRentalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tanggal_laporan' => 'required|date|unique:laporan_rentals',
            'total_transaksi' => 'required|integer|min:0',
            'total_pendapatan' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|min:5',
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_laporan.required' => 'Tanggal laporan wajib diisi.',
            'tanggal_laporan.date' => 'Format tanggal laporan tidak valid.',
            'tanggal_laporan.unique' => 'Laporan untuk tanggal ini sudah ada.',
            
            'total_transaksi.required' => 'Total transaksi wajib diisi.',
            'total_transaksi.integer' => 'Total transaksi harus berupa angka bulat.',
            'total_transaksi.min' => 'Total transaksi minimal 0.',
            
            'total_pendapatan.required' => 'Total pendapatan wajib diisi.',
            'total_pendapatan.numeric' => 'Total pendapatan harus berupa angka.',
            'total_pendapatan.min' => 'Total pendapatan minimal Rp 0.',
            
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.min' => 'Keterangan minimal 5 karakter jika diisi.',
        ];
    }
}
