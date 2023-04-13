<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_header_id',
        'code',
        'number',
        'product_code',
        'price',
        'quantity',
        'unit',
        'subtotal',
        'currency',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'code', 'product_code');
    }
}
