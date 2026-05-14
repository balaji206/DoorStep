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
        'day_of_week'   => 'required|array|min:1',
        'day_of_week.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
        'start_time'    => 'required',
        'end_time'      => 'required|after:start_time',
    ];
}

public function messages(): array
{
    return [
        'day_of_week.required' => 'Please select at least one day',
        'day_of_week.min'      => 'Please select at least one day',
        'start_time.required'  => 'Please enter start time',
        'end_time.required'    => 'Please enter end time',
        'end_time.after'       => 'End time must be after start time',
    ];
}
}