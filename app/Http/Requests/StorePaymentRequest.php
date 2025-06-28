<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'booking_id' => 'required|integer|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'payment_method' => 'nullable|string|max:50',
        ];
    }
} 