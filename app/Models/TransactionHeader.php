<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    protected $fillable = [
        'code',
        'number',
        'user',
        'total',
        'date',
    ];

    protected $appends = [
        'transaction_code'
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_header_id', 'id');
    }

    public function getTransactionCodeAttribute()
    {
        return "{$this->code}-{$this->number}";
    }
}
