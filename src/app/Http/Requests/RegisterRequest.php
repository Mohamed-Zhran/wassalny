<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:3|max:100',
            'last_name' => 'required|string|min:3|max:100',
            'email' => 'required|email:rfc,dns,spoof|string',
            'username' => 'required|string|min:8|max:100',
            'password' => 'required|string|min:8|max:20|confirmed',
            'password_confirmation' => 'required',
            'role_id'=>'required|exists:roles,id|integer'
        ];
    }
}
