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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('payment_key')->unique()->nullable(); // 토스 결제 키
            $table->string('order_id_toss')->nullable(); // 토스 주문 ID
            $table->string('method')->nullable(); // 결제 수단
            $table->decimal('amount', 10, 2); // 결제 금액
            $table->enum('status', ['ready', 'in_progress', 'done', 'canceled', 'partial_canceled', 'aborted', 'expired'])->default('ready');
            $table->string('receipt_url')->nullable(); // 영수증 URL
            $table->json('raw_data')->nullable(); // 토스에서 받은 전체 응답
            $table->timestamp('approved_at')->nullable(); // 결제 승인 시간
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
