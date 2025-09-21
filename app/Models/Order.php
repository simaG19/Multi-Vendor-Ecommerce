<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $fillable = [
    'user_id',
    'phone',
    'order_number',
    'total',
    'status',
    'shipping_address',
    'payment_screenshot_path',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }


}
