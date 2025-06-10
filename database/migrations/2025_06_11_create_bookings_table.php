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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique(); // 예약번호
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->nullable()->constrained()->onDelete('set null');
            
            // 예약 정보
            $table->date('booking_date'); // 예약 날짜
            $table->time('booking_time'); // 예약 시간
            $table->integer('duration')->default(40); // 수업 시간 (분)
            
            // 예약자 정보
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->string('parent_email');
            $table->integer('child_age');
            $table->text('special_notes')->nullable(); // 특이사항
            
            // 결제 정보
            $table->decimal('amount', 10, 2); // 결제 금액
            $table->string('payment_status')->default('pending'); // pending, paid, cancelled, refunded
            $table->string('payment_method')->nullable(); // 결제 방법
            $table->string('payment_key')->nullable(); // 토스페이먼츠 결제 키
            $table->timestamp('paid_at')->nullable(); // 결제 완료 시간
            
            // 예약 상태
            $table->string('status')->default('pending'); // pending, confirmed, completed, cancelled
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->string('cancel_reason')->nullable();
            
            $table->timestamps();
            
            // 인덱스
            $table->index(['booking_date', 'booking_time']);
            $table->index(['user_id', 'status']);
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
