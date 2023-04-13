<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'quantity'
    ];

    protected $appends = [
        'sub_total'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function getSubTotalAttribute()
    {
        return $this->quantity * $this->product->price_discount;
    }
}
