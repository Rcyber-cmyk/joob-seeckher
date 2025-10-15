<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Dapatkan aturan validasi yang berlaku untuk permintaan tersebut.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user())],
        ];
    }

    /**
     * Menentukan apakah pengguna berwenang untuk membuat permintaan ini.
     * (Kita set true agar semua pengguna yang login bisa mengedit profilnya sendiri)
     */
    public function authorize(): bool
    {
        return true;
    }
}