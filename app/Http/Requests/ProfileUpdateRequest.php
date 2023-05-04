<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'photo' => ['file', 'max:2048', 'nullable'],
            'jabatan' => ['string', 'max:255'],
            'nama' => ['string', 'max:255'],
            'email' => ['email', 'max:255','nullable', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
