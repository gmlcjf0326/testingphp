<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\TeacherSchedule;

class TeacherScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = Teacher::all();
        
        foreach ($teachers as $teacher) {
            // 각 선생님마다 주중 스케줄 생성
            for ($day = 1; $day <= 5; $day++) { // 월요일부터 금요일
                // 오전 시간대 (9:00 - 12:00)
                TeacherSchedule::create([
                    'teacher_id' => $teacher->id,
                    'day_of_week' => $day,
                    'start_time' => '09:00',
                    'end_time' => '12:00',
                    'is_available' => true,
                ]);
                
                // 오후 시간대 (14:00 - 18:00)
                TeacherSchedule::create([
                    'teacher_id' => $teacher->id,
                    'day_of_week' => $day,
                    'start_time' => '14:00',
                    'end_time' => '18:00',
                    'is_available' => true,
                ]);
            }
            
            // 토요일 스케줄 (일부 선생님만)
            if ($teacher->id % 2 == 0) {
                TeacherSchedule::create([
                    'teacher_id' => $teacher->id,
                    'day_of_week' => 6,
                    'start_time' => '10:00',
                    'end_time' => '14:00',
                    'is_available' => true,
                ]);
            }
        }
    }
}
