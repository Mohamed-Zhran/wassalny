<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTripRequest extends FormRequest
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
            'beginning_lat' => 'required|decimal:2,8|numeric',
            'beginning_lng' => 'required|decimal:2,8|numeric',
            'destination_lat' => 'required|decimal:2,8|numeric',
            'destination_lng' => 'required|decimal:2,8|numeric',
            'available_seats' => 'required|integer|min:2|max:54',
        ];
    }
}
