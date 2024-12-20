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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['required', 'digits:10', Rule::unique(User::class)->ignore($this->user()->id)],
            // 'alternate_phone' => ['sometimes', 'digits:10', Rule::unique(User::class)->ignore($this->user()->id)],
            'profile_pic' => ['sometimes', 'image', 'mimes:png,jpeg,jpg,webp', 'max:512', 'dimensions:max_width=200,max_height=200'],
            'gender' => ['sometimes', 'in:Male,Female'],
            'current_address' => ['sometimes', 'max:255']
        ];
    }
}
