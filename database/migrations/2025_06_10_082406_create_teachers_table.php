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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->text('bio'); // 선생님 소개
            $table->json('specialties'); // 전문 분야 ["음악동화", "피아노"]
            $table->json('education'); // 학력 사항
            $table->json('experience'); // 경력 사항
            $table->string('location'); // 활동 지역
            $table->decimal('rating', 3, 2)->default(0); // 평점 (0.00 ~ 5.00)
            $table->integer('review_count')->default(0);
            $table->integer('lesson_count')->default(0); // 총 수업 횟수
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
