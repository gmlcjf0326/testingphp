<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Teacher;
use App\Models\Program;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            // 박영미 선생님 리뷰
            [
                'teacher_id' => 1,
                'program_id' => 2, // 홈피아노
                'parent_name' => '원성희',
                'child_name' => '원서연',
                'child_age' => 7,
                'rating' => 5,
                'content' => '급히 요청했는데 좋은 분이 와주셔서 너무 감사했습니다. 아이가 어제 오셨던 선생님 언제 또 오시냐고 물어보네요~ 따뜻하고 상냥하신 선생님이십니다❤️',
                'is_approved' => true,
                'created_at' => now()->subMinutes(24),
            ],
            [
                'teacher_id' => 1,
                'program_id' => 2,
                'parent_name' => '김정현',
                'child_name' => '김민준',
                'child_age' => 8,
                'rating' => 5,
                'content' => '피아노를 처음 배우는 아이인데 선생님께서 아이의 수준에 맞춰 차근차근 가르쳐 주셔서 감동했습니다. 아이가 피아노에 흥미를 가지게 되었어요!',
                'is_approved' => true,
                'created_at' => now()->subDays(2),
            ],
            // 강다은 선생님 리뷰
            [
                'teacher_id' => 2,
                'program_id' => 1, // 음악동화
                'parent_name' => '송지혜',
                'child_name' => '송하은',
                'child_age' => 5,
                'rating' => 5,
                'content' => '너무 기쁜 피드백이에요 ! 🥰 가족 외에 쉽게 경을(?) 잘 안줘서 조금 걱정이었는데, 선생님께 감사드립니다. 앞으로도 잘 부탁 드립니다 🫶🏻',
                'is_approved' => true,
                'created_at' => now()->subMinutes(50),
            ],
            [
                'teacher_id' => 2,
                'program_id' => 4, // 뮤지컬
                'parent_name' => '한주연',
                'child_name' => '한서우',
                'child_age' => 9,
                'rating' => 5,
                'content' => '처음 헤어지는거라 좀 걱정됐는데…아이가 다음에 또 악어선생님 만나고싶다고 하네요😊기회되면 또 뵐요^^',
                'is_approved' => true,
                'created_at' => now()->subDays(6)->subHours(9),
            ],
            // 이다영 선생님 리뷰
            [
                'teacher_id' => 3,
                'program_id' => 6, // 바이올린
                'parent_name' => '고은주',
                'child_name' => '고지호',
                'child_age' => 6,
                'rating' => 5,
                'content' => '아기가 너무 즐거운 시간 보냈어요~상호작용 열심히 해주시고 알차게 놀아주셔서 넘 감사했어요~',
                'is_approved' => true,
                'created_at' => now()->subHours(1),
            ],
            // 서여정 선생님 리뷴
            [
                'teacher_id' => 4,
                'program_id' => 4, // 뮤지컬
                'parent_name' => '박영진',
                'child_name' => '박서연',
                'child_age' => 10,
                'rating' => 5,
                'content' => '아이가 어제 저녁에 선생님과의 시간이 너무 행복했다고 얘기하네요. 세시간 알차게 놀아주셔서 너무 감사했습니다! 다음에 기회되면 또 연락드릴게요 😊',
                'is_approved' => true,
                'created_at' => now()->subHours(4),
            ],
            // 류수용 선생님 리뷴
            [
                'teacher_id' => 5,
                'program_id' => 2, // 피아노
                'parent_name' => '이하나',
                'child_name' => '이지훈',
                'child_age' => 8,
                'rating' => 5,
                'content' => '아이들이 제일 좋아하는 돌봄선생님이세요🥹 멀리서 와주시는데 아이들을 잘 돌봐주셔서 넘넘 감사해요',
                'is_approved' => true,
                'created_at' => now()->subHours(5),
            ],
            // 양금례 선생님 리뷴
            [
                'teacher_id' => 6,
                'program_id' => 1, // 음악동화
                'parent_name' => '민세라',
                'child_name' => '민서준',
                'child_age' => 4,
                'rating' => 5,
                'content' => '저희아이가 수업진행시간동안 엄마아빠를 쳐다보지도 않더군요..선생님께만 집중해서 놀이를 하더라구요.선생님가실때도 너무나 아쉬워하고 또 언제 오시냐 묻더라구요 !정말 감사합니다 !',
                'is_approved' => true,
                'created_at' => now()->subHours(7),
            ],
            [
                'teacher_id' => 6,
                'program_id' => 5, // 음악놀이 베이비
                'parent_name' => '유지아',
                'child_name' => '유시온',
                'child_age' => 2,
                'rating' => 5,
                'content' => '항상 아이가 즐거워합니다^^',
                'is_approved' => true,
                'created_at' => now()->subDays(6)->subHours(9),
            ],
            [
                'teacher_id' => 6,
                'program_id' => 1,
                'parent_name' => '안나경',
                'child_name' => '안세준',
                'child_age' => 5,
                'rating' => 5,
                'content' => '정말 정말 너무 잘 놀아 주셔서 아이가 너무 즐거워했어요. 한 자리에서 그렇게 오래 앉아서 노는 거는 처음 봤어요. 선생님 정말 베테랑이신 것 같아요! 다음에 기회 되면 정말 다시 뜵고 싶네요 시간 되시면 꼭 연락 주세요. 오늘 수고하셨습니다.☺️',
                'is_approved' => true,
                'created_at' => now()->subHours(20),
            ],
        ];
        
        foreach ($reviews as $review) {
            Review::create($review);
        }
        
        // 선생님들의 평점 업데이트
        $teachers = Teacher::all();
        foreach ($teachers as $teacher) {
            $teacher->updateRating();
        }
    }
}
