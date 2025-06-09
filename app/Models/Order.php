<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'total_amount',
        'status',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    /**
     * 주문 생성 시 자동으로 주문번호 생성
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = 'ORD-' . date('YmdHis') . '-' . strtoupper(substr(uniqid(), -4));
        });
    }

    /**
     * 사용자 관계
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 주문 상품 관계
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * 결제 정보 관계
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
