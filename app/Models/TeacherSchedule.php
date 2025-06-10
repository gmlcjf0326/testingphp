<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    /**
     * 요일 이름 배열
     */
    const DAYS = [
        0 => '일요일',
        1 => '월요일',
        2 => '화요일',
        3 => '수요일',
        4 => '목요일',
        5 => '금요일',
        6 => '토요일',
    ];

    /**
     * 관계 정의
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * 요일 이름 가져오기
     */
    public function getDayNameAttribute()
    {
        return self::DAYS[$this->day_of_week] ?? '';
    }

    /**
     * 특정 날짜의 예약 가능한 시간대 조회
     */
    public static function getAvailableSlots($teacherId, $date, $duration = 40)
    {
        $dayOfWeek = date('w', strtotime($date));
        
        $schedules = self::where('teacher_id', $teacherId)
                         ->where('day_of_week', $dayOfWeek)
                         ->where('is_available', true)
                         ->get();
        
        $slots = [];
        
        foreach ($schedules as $schedule) {
            $startTime = strtotime($date . ' ' . $schedule->start_time);
            $endTime = strtotime($date . ' ' . $schedule->end_time);
            
            // 40분 단위로 시간대 생성
            for ($time = $startTime; $time + ($duration * 60) <= $endTime; $time += $duration * 60) {
                $slotTime = date('H:i', $time);
                
                // 이미 예약된 시간인지 확인
                $isBooked = Booking::where('teacher_id', $teacherId)
                                   ->where('booking_date', $date)
                                   ->where('booking_time', $slotTime)
                                   ->whereIn('status', ['pending', 'confirmed'])
                                   ->exists();
                
                if (!$isBooked) {
                    $slots[] = [
                        'time' => $slotTime,
                        'display' => date('H:i', $time) . ' - ' . date('H:i', $time + ($duration * 60))
                    ];
                }
            }
        }
        
        return $slots;
    }
}
