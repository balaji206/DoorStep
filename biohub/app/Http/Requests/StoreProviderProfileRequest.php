<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'business_name' => 'required|string|max:255',
            'category'      => 'required|string',
            'description'   => 'nullable|string|max:500',
            'location'      => 'required|string|max:255',
            'phone'         => 'required|string|min:10|max:15',
        ];
    }

    public function messages(): array
    {
        return [
            'business_name.required' => 'Please enter your business name',
            'category.required'      => 'Please select a category',
            'location.required'      => 'Please enter your location',
            'phone.required'         => 'Please enter your phone number',
            'phone.min'              => 'Phone number must be at least 10 digits',
        ];
    }
}