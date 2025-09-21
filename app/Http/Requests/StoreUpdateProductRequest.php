<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        // allow authenticated requests — further checks (ownership) done in controller
        return $this->user() !== null;
    }

    public function rules()
    {
        $productId = $this->route('product')?->id ?? null;

        // detect admin (role OR boolean)
        $user = $this->user();
        $isAdmin = false;
        if ($user) {
            if (isset($user->role) && is_string($user->role)) {
                $isAdmin = strtolower($user->role) === 'admin';
            }
            if (! $isAdmin && isset($user->is_admin)) {
                $isAdmin = boolval($user->is_admin);
            }
        }

        return [
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
}
