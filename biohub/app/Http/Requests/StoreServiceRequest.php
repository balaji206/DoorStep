<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'             => 'required|string|max:255',
            'duration_minutes' => 'required|integer|min:15|max:480',
            'price'            => 'required|numeric|min:0|max:99999',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'             => 'Please enter a service name',
            'duration_minutes.required' => 'Please enter duration',
            'duration_minutes.min'      => 'Minimum duration is 15 minutes',
            'duration_minutes.max'      => 'Maximum duration is 480 minutes (8 hours)',
            'price.required'            => 'Please enter a price',
            'price.min'                 => 'Price cannot be negative',
        ];
    }
}