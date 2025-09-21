<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminVendorUpdateRequest extends FormRequest
{
    public function authorize()
    {
        // admin middleware already guards this route but keep double-check
        return $this->user() && (isset($this->user()->role) && strtolower($this->user()->role) === 'admin' || !empty($this->user()->is_admin));
    }

    public function rules()
    {
        return [
            'business_name' => 'required|string|max:255',
            'tin_number'    => 'nullable|string|max:100',
            'address'       => 'nullable|string|max:1000',
            'contact_phone' => 'nullable|string|max:50',
            'is_approved'   => 'sometimes|boolean',
            'status'        => 'nullable|in:pending,approved,rejected,suspended',
        ];
    }
}
