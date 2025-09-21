<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        // Allow only authenticated users to proceed to validation.
        // We also allow further admin checks in rules() (so a logged-in admin can create with no vendor).
        return $this->user() !== null;
    }

    public function rules()
    {
        // If editing, get product id for unique rules
        $productId = $this->route('product')?->id ?? null;

        // Determine whether current user is an "admin"
        $user = $this->user();

        // robust check: supports either role column or boolean is_admin
        $isAdmin = false;
        if ($user) {
            // role can be 'admin' or 'Admin' etc. Normalize to lowercase for safety
            if (isset($user->role) && is_string($user->role)) {
                $isAdmin = strtolower($user->role) === 'admin';
            }
            if (! $isAdmin && isset($user->is_admin)) {
                // handle boolean flag if present
                $isAdmin = boolval($user->is_admin);
            }
        }

        // If you still get unexpected behavior, temporarily uncomment the next line
        // to inspect the authenticated user and rules during form submission:
        // dd(['user' => $user?->toArray() ?? null, 'isAdmin' => $isAdmin]);

        return [
            // allow null vendor_id for admins, but require it for vendors (non-admins)
            'vendor_id' => $isAdmin ? 'nullable|exists:vendors,id' : 'required|exists:vendors,id',

            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:80|unique:products,sku,' . ($productId ?? 'NULL') . ',id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'brand' => 'nullable|string|max:120',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'category_id' => 'nullable|exists:categories,id',
            'is_active' => 'sometimes|boolean',
            'images.*' => 'nullable|image|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'vendor_id.required' => 'Please select a vendor (or leave blank for admin-created products).',
        ];
    }
}
