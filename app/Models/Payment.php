<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_key',
        'order_id_toss',
        'method',
        'amount',
        'status',
        'receipt_url',
        'raw_data',
        'approved_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'raw_data' => 'array',
        'approved_at' => 'datetime',
    ];

    /**
     * 주문 관계
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
