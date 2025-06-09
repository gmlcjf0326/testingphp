<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 상품명
            $table->decimal('price', 10, 2); // 가격 (최대 10자리, 소수점 2자리)
            $table->string('image')->nullable(); // 이미지 경로
            $table->text('description')->nullable(); // 상품 설명
            $table->integer('stock')->default(0); // 재고 수량
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
