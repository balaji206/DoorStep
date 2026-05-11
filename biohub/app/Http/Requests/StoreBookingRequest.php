<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_id'   => 'required|exists:services,id',
            'booking_date' => 'required|date|after:today',
            'start_time'   => 'required',
            'notes'        => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required'   => 'Please select a service',
            'service_id.exists'     => 'Selected service does not exist',
            'booking_date.required' => 'Please select a date',
            'booking_date.after'    => 'Booking date must be a future date',
            'start_time.required'   => 'Please select a time',
        ];
    }
}