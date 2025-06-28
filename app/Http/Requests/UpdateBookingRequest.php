<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'table_id' => 'nullable|integer|exists:tables,id',
            'group_size' => 'required|integer|min:1',
            'event_type' => 'nullable|string|max:255',
            'special_instructions' => 'nullable|string|max:1000',
            'status' => 'nullable|in:pending,confirmed,cancelled,waitlist',
        ];
    }
} 