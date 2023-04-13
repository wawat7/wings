<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code',
        'name',
        'price',
        'currency',
        'discount',
        'dimension',
        'unit'
    ];

    protected $appends = [
        'price_discount',
    ];

    public function getPriceDiscountAttribute()
    {
        $discount = ($this->discount/100) * $this->price;
        return $this->price - $discount;
    }
}
