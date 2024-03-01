<?php

namespace App\Http\Requests\Security;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * This validates if the Passwords were sent
 */
class PasswordChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required|current_password:web',
            'new_password' => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required',
        ];
    }
}
