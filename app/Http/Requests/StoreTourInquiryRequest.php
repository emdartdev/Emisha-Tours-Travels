<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tour_id' => ['nullable', 'exists:tours,id'],
            'tour_title' => ['nullable', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'travel_date' => ['nullable', 'date', 'after_or_equal:today'],
            'adults' => ['nullable', 'integer', 'min:1', 'max:100'],
            'children' => ['nullable', 'integer', 'min:0', 'max:50'],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
