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
        Schema::create('teacher_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('day_of_week'); // 0=일요일, 1=월요일, ... 6=토요일
            $table->time('start_time'); // 시작 시간
            $table->time('end_time'); // 종료 시간
            $table->boolean('is_available')->default(true); // 가능 여부
            $table->timestamps();
            
            // 인덱스
            $table->index(['teacher_id', 'day_of_week']);
            $table->unique(['teacher_id', 'day_of_week', 'start_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_schedules');
    }
};
