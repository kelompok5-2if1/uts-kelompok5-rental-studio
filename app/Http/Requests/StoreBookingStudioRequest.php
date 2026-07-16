<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingStudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'studio_id' => 'required|exists:studios,id',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|string|in:Pending,Selesai,Batal',
        ];
    }

    public function messages(): array
    {
        return [
            'pelanggan_id.required' => 'Pelanggan wajib dipilih.',
            'pelanggan_id.exists' => 'Pelanggan tidak ditemukan.',
            
            'studio_id.required' => 'Studio wajib dipilih.',
            'studio_id.exists' => 'Studio tidak ditemukan.',
            
            'tanggal_booking.required' => 'Tanggal booking wajib diisi.',
            'tanggal_booking.date' => 'Format tanggal tidak valid.',
            'tanggal_booking.after_or_equal' => 'Tanggal booking tidak boleh di masa lalu.',
            
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format' => 'Format jam mulai harus HH:MM.',
            
            'jam_selesai.required' => 'Jam selesai wajib diisi.',
            'jam_selesai.date_format' => 'Format jam selesai harus HH:MM.',
            'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai.',
            
            'total_harga.required' => 'Total harga wajib diisi.',
            'total_harga.integer' => 'Total harga harus berupa angka bulat.',
            'total_harga.min' => 'Total harga minimal Rp 1.',
            
            'status.required' => 'Status wajib diisi.',
            'status.string' => 'Status harus berupa teks.',
            'status.in' => 'Status harus Pending, Selesai, atau Batal.',
        ];
    }
}
