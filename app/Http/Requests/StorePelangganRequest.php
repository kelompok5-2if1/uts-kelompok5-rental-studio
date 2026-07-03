<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePelangganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:pelanggans,email',
            'no_hp' => 'required|string|min:10|max:15',
            'alamat' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama pelanggan wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.min' => 'Nomor HP minimal 10 digit.',
            'alamat.required' => 'Alamat wajib diisi.',
        ];
    }
}