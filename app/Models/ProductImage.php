<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $fillable = ['product_id','path','filename','position'];

    // convenience accessor to a full URL
    public function getUrlAttribute()
    {
        // assumes 'public' disk; Storage::url() will map to /storage/...
        return Storage::url($this->path);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // When deleting a model, remove file from disk
    protected static function booted()
    {
        static::deleting(function ($image) {
            if ($image->path && Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
        });
    }
}
