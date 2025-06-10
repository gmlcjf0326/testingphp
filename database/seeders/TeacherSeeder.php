<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => '박영미',
                'email' => 'park.ym@musitory.com',
                'phone' => '010-1234-5678',
                'photo' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400',
                'bio' => '독일에서 피아노 연주를 전공하고 15년간 아이들을 가르쳐온 전문가입니다. 아이들의 눈높이에 맞춰 음악을 재미있게 가르치는 것이 저의 교육 철학입니다.',
                'specialties' => ['피아노', '음악동화'],
                'education' => ['한국예술종합학교 피아노과 졸업', '독일 베를린 예술대학 석사'],
                'experience' => ['뮤지토리 피아노 전문강사 10년', '서울시립교향악단 객원 연주자'],
                'location' => '서울 노원구',
                'rating' => 4.9,
                'review_count' => 42,
                'lesson_count' => 850,
            ],
            [
                'name' => '강다은',
                'email' => 'kang.de@musitory.com',
                'phone' => '010-2345-6789',
                'photo' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400',
                'bio' => '음악동화 전문가로 아이들의 상상력을 자극하는 스토리텔링 수업을 진행합니다. 프랑스에서의 유학 경험을 바탕으로 유럽식 음악 교육을 접목시킨 커리큘럼을 운영하고 있습니다.',
                'specialties' => ['음악동화', '성악', '뮤지컬'],
                'education' => ['서울대학교 성악과 졸업', '프랑스 파리 국립음악원 수료'],
                'experience' => ['뮤지토리 대표 강사', '어린이 뮤지컬 음악감독 5년'],
                'location' => '서울 구로구',
                'rating' => 4.95,
                'review_count' => 38,
                'lesson_count' => 620,
            ],
            [
                'name' => '이다영',
                'email' => 'lee.dy@musitory.com',
                'phone' => '010-3456-7890',
                'photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400',
                'bio' => '바이올린 연주자로 활동하며 아이들에게 현악기의 매력을 전하고 있습니다. 체계적인 기초 훈련과 함께 음악의 즐거움을 강조하는 수업을 진행합니다.',
                'specialties' => ['바이올린', '쳼로', '피아노'],
                'education' => ['연세대학교 음악대학 바이올린 전공', '이탈리아 밀라노 음악원 수료'],
                'experience' => ['국립교향악단 단원 활동', '어린이 현악 앙상블 지도'],
                'location' => '경기 의정부시',
                'rating' => 4.85,
                'review_count' => 29,
                'lesson_count' => 480,
            ],
            [
                'name' => '서여정',
                'email' => 'seo.yj@musitory.com',
                'phone' => '010-4567-8901',
                'photo' => 'https://images.unsplash.com/photo-1488508872907-592763824245?w=400',
                'bio' => '뮤지컬 배우로 10년간 활동하며 척박한 국내 뮤지컬 현장에서 얻은 경험을 아이들과 나누고 있습니다. 노래, 연기, 춤을 통합한 종합 예술 교육을 지향합니다.',
                'specialties' => ['뮤지컬', '성악', '연기'],
                'education' => ['한국예술종합학교 뮤지컬과', '뉴욕 브로드웨이 워크샵 수료'],
                'experience' => ['뮤지컬 배우 10년', '어린이 뮤지컬 연출 5편'],
                'location' => '경기 의정부시',
                'rating' => 4.88,
                'review_count' => 45,
                'lesson_count' => 720,
            ],
            [
                'name' => '류수용',
                'email' => 'ryu.sy@musitory.com',
                'phone' => '010-5678-9012',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
                'bio' => '클래식 피아니스트로 활동하며 음악 이론과 실기를 균형 있게 가르치고 있습니다. 아이들의 개성을 존중하며 창의적인 음악 표현을 독려합니다.',
                'specialties' => ['피아노', '음악이론', '작곡'],
                'education' => ['서울대학교 음악대학 피아노과', '미국 줄리아드 음악원 박사'],
                'experience' => ['국제 피아노 콩쿠르 입상', '음악대학 강사 5년'],
                'location' => '서울 은평구',
                'rating' => 4.92,
                'review_count' => 55,
                'lesson_count' => 920,
            ],
            [
                'name' => '양금례',
                'email' => 'yang.gr@musitory.com',
                'phone' => '010-6789-0123',
                'photo' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400',
                'bio' => '유아 음악 교육 전문가로 20년간 아이들과 함께하고 있습니다. 오르프 교육법을 기반으로 한 신체 활동과 음악을 결합한 통합 교육을 실천합니다.',
                'specialties' => ['음악동화', '유아음악', '오르프'],
                'education' => ['이화여자대학교 음악대학', '오스트리아 잘츠부르크 오르프 연구소'],
                'experience' => ['유아 음악 교육 20년', '국립어린이청소년극회 음악감독'],
                'location' => '경기 군포시',
                'rating' => 4.98,
                'review_count' => 89,
                'lesson_count' => 1580,
            ],
        ];
        
        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
