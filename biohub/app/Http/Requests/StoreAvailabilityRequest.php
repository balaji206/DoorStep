<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvailabilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'day_of_week' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'start_time'  => 'required',
            'end_time'    => 'required|after:start_time',
        ];
    }

    public function messages(): array
    {
        return [
            'day_of_week.required' => 'Please select a day',
            'day_of_week.in'       => 'Please select a valid day',
            'start_time.required'  => 'Please enter start time',
            'end_time.required'    => 'Please enter end time',
            'end_time.after'       => 'End time must be after start time',
        ];
    }
}