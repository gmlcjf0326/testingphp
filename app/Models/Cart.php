<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * 대량 할당 가능한 속성들
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /**
     * 사용자 관계 정의
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 상품 관계 정의
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
