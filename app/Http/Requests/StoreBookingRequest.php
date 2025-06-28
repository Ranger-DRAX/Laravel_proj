<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'table_id' => 'nullable|integer|exists:tables,id',
            'branch_id' => 'required|integer|exists:branches,id',
            'group_size' => 'required|integer|min:1',
            'event_type' => 'nullable|string|max:255',
            'special_instructions' => 'nullable|string|max:1000',
            'status' => 'nullable|in:pending,confirmed,cancelled,waitlist',
        ];
    }
} 