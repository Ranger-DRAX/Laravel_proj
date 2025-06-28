<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTableRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'branch_id' => 'required|integer|exists:branches,id',
            'table_number' => 'required|string|max:20',
            'seating_capacity' => 'required|integer|min:1',
            'layout_x' => 'nullable|integer',
            'layout_y' => 'nullable|integer',
        ];
    }
} 