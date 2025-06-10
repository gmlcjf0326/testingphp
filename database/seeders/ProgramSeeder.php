<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'name' => '뮤지토리 음악동화',
                'category' => '음악동화',
                'description' => '음악과 이야기가 만나는 특별한 수업! 클래식 음악을 동화와 함께 배우며 상상력과 음악적 감수성을 키워요.',
                'age_group' => '4-7세',
                'duration' => 50,
                'price' => 120000,
                'image' => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=600',
                'icon' => '🎵',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'name' => '뮤지토리 홈피아노',
                'category' => '피아노',
                'description' => '집에서 편안하게 배우는 1:1 피아노 레슨. 아이의 수준에 맞춘 맞춤형 커리큘럼으로 진행됩니다.',
                'age_group' => '5세 이상',
                'duration' => 40,
                'price' => 150000,
                'image' => 'https://images.unsplash.com/photo-1552422535-c45813c61732?w=600',
                'icon' => '🎹',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'name' => '키즈 성악 클래스',
                'category' => '성악',
                'description' => '올바른 발성법과 호흡법을 배우며 아름다운 목소리를 만들어가요. 동요부터 뮤지컬 넘버까지!',
                'age_group' => '6-12세',
                'duration' => 45,
                'price' => 100000,
                'image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=600',
                'icon' => '🎤',
                'is_featured' => false,
                'order' => 3,
            ],
            [
                'name' => '어린이 뮤지컬',
                'category' => '뮤지컬',
                'description' => '노래, 연기, 춤을 통합한 종합 예술 교육. 자신감과 표현력을 기르고 무대 위의 주인공이 되어보세요!',
                'age_group' => '7-13세',
                'duration' => 90,
                'price' => 180000,
                'image' => 'https://images.unsplash.com/photo-1547153760-18fc86324498?w=600',
                'icon' => '🎭',
                'is_featured' => true,
                'order' => 4,
            ],
            [
                'name' => '음악놀이 베이비',
                'category' => '음악동화',
                'description' => '엄마와 함께하는 오감발달 음악놀이. 다양한 악기와 소리를 탐색하며 음악적 기초를 다져요.',
                'age_group' => '18-36개월',
                'duration' => 40,
                'price' => 80000,
                'image' => 'https://images.unsplash.com/photo-1544776193-352d25ca82cd?w=600',
                'icon' => '👶',
                'is_featured' => false,
                'order' => 5,
            ],
            [
                'name' => '바이올린 클래스',
                'category' => '기악',
                'description' => '아름다운 선율의 바이올린을 배워보세요. 기초부터 차근차근, 개인 맞춤형 레슨으로 진행됩니다.',
                'age_group' => '6세 이상',
                'duration' => 45,
                'price' => 160000,
                'image' => 'https://images.unsplash.com/photo-1612225330812-01a9c6b355ec?w=600',
                'icon' => '🎻',
                'is_featured' => true,
                'order' => 6,
            ],
        ];
        
        foreach ($programs as $index => $program) {
            // Generate slug with index to ensure uniqueness for Korean text
            $program['slug'] = 'program-' . ($index + 1) . '-' . Str::slug($program['category']);
            Program::create($program);
        }
    }
}
