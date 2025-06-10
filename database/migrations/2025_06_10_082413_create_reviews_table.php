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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->foreignId('program_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('parent_name'); // 학부모 이름
            $table->string('child_name'); // 아이 이름
            $table->integer('child_age'); // 아이 나이
            $table->integer('rating'); // 평점 (1-5)
            $table->text('content'); // 리뷰 내용
            $table->boolean('is_approved')->default(false); // 승인 여부
            $table->timestamps();
            
            $table->index(['teacher_id', 'is_approved']);
            $table->index(['created_at', 'is_approved']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
