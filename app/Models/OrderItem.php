<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /**
     * 주문 관계
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * 상품 관계
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
