<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number',
        'user_id',
        'program_id',
        'teacher_id',
        'booking_date',
        'booking_time',
        'duration',
        'parent_name',
        'parent_phone',
        'parent_email',
        'child_age',
        'special_notes',
        'amount',
        'payment_status',
        'payment_method',
        'payment_key',
        'paid_at',
        'status',
        'confirmed_at',
        'cancelled_at',
        'cancel_reason',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'booking_time' => 'datetime:H:i',
        'paid_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    /**
     * 예약번호 생성
     */
    public static function generateBookingNumber()
    {
        $prefix = 'BK';
        $date = now()->format('ymd');
        $random = strtoupper(substr(uniqid(), -4));
        
        return $prefix . $date . $random;
    }

    /**
     * 관계 정의
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * 스코프
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('booking_date', '>=', now()->toDateString())
                     ->orderBy('booking_date')
                     ->orderBy('booking_time');
    }

    /**
     * 예약 시작 시간 (날짜+시간)
     */
    public function getStartDateTimeAttribute()
    {
        return $this->booking_date->setTimeFromTimeString($this->booking_time);
    }

    /**
     * 예약 종료 시간
     */
    public function getEndDateTimeAttribute()
    {
        return $this->start_date_time->addMinutes($this->duration);
    }

    /**
     * 상태 확인 메서드
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }
}
