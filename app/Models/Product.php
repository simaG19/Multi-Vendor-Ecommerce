<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // app/Models/Product.php
 protected $fillable = [
        'vendor_id','name','sku','description','price','stock','brand',
        'discount_percent','category_id','is_active','created_by',
        'img_1','img_2','img_3'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
public function category()
{
    return $this->belongsTo(Category::class);
}
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function images()
{
    return $this->hasMany(ProductImage::class)->orderBy('position');
}
   public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

protected static function booted()
{
    static::deleting(function ($product) {
        // delete images files from disk (in case cascade DB doesn't remove files)
        foreach ($product->images as $img) {
            if ($img->path && \Storage::disk('public')->exists($img->path)) {
                \Storage::disk('public')->delete($img->path);
            }
        }
    });
}

}
