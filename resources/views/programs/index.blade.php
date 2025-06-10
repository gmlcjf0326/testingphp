@extends('layouts.musitory')

@section('content')
<style>
    .programs-hero {
        background: linear-gradient(135deg, #FDF6F0 0%, #FFE8E0 100%);
        padding: 60px 40px;
        text-align: center;
    }
    
    .programs-hero h1 {
        font-size: 42px;
        font-weight: 700;
        color: #1B1B18;
        margin-bottom: 15px;
    }
    
    .programs-section {
        padding: 60px 40px;
    }
    
    .category-section {
        margin-bottom: 80px;
    }
    
    .category-title {
        font-size: 28px;
        font-weight: 700;
        color: #1B1B18;
        margin-bottom: 10px;
        padding-bottom: 15px;
        border-bottom: 3px solid #FF6B35;
        display: inline-block;
    }
    
    .programs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        margin-top: 30px;
    }
    
    .program-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }
    
    .program-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    
    .program-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .program-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #FF6B35;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .program-content {
        padding: 25px;
    }
    
    .program-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .program-icon {
        font-size: 32px;
    }
    
    .program-title {
        font-size: 20px;
        font-weight: 600;
        color: #1B1B18;
        margin: 0;
    }
    
    .program-description {
        font-size: 14px;
        color: #706F6C;
        line-height: 1.6;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .program-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        border-top: 1px solid #E3E3E0;
    }
    
    .program-meta {
        display: flex;
        gap: 20px;
        font-size: 13px;
        color: #706F6C;
    }
    
    .program-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .program-price {
        font-size: 18px;
        font-weight: 700;
        color: #FF6B35;
    }
    
    .program-price small {
        font-size: 13px;
        font-weight: 400;
        color: #706F6C;
    }
    
    .featured-badge {
        background: #FFD700;
        color: #1B1B18;
    }
    
    .category-description {
        font-size: 15px;
        color: #706F6C;
        margin-top: 10px;
        line-height: 1.6;
    }
    
    @media (max-width: 768px) {
        .programs-hero h1 {
            font-size: 32px;
        }
        
        .programs-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="programs-hero">
    <h1>뮤지토리 교육 프로그램</h1>
    <p>아이의 음악적 잠재력을 깨우는 특별한 커리큘럼</p>
</div>

<section class="programs-section">
    @foreach($programs as $category => $categoryPrograms)
    <div class="category-section">
        <h2 class="category-title">{{ $category }}</h2>
        
        @if($category == '음악동화')
            <p class="category-description">
                동화 속 이야기와 함께 떠나는 음악 여행! 상상력과 음악적 감수성을 동시에 키워요.
            </p>
        @elseif($category == '피아노')
            <p class="category-description">
                기초부터 탄탄하게! 개인 맞춤형 피아노 레슨으로 음악의 즐거움을 경험해요.
            </p>
        @elseif($category == '성악')
            <p class="category-description">
                올바른 발성법과 호흡법으로 아름다운 목소리를 만들어가요.
            </p>
        @elseif($category == '뮤지컬')
            <p class="category-description">
                노래, 연기, 춤을 통한 종합 예술 교육! 자신감 넘치는 무대의 주인공이 되어보세요.
            </p>
        @elseif($category == '기악')
            <p class="category-description">
                다양한 악기와의 만남! 아이의 취향에 맞는 악기로 음악을 시작해요.
            </p>
        @endif
        
        <div class="programs-grid">
            @foreach($categoryPrograms as $program)
            <div class="program-card" onclick="location.href='{{ route('programs.show', $program->id) }}'">
                <div class="program-image">
                    <img src="{{ $program->image ?? 'https://via.placeholder.com/400x200' }}" alt="{{ $program->name }}">
                    @if($program->is_featured)
                        <span class="program-badge featured-badge">추천</span>
                    @endif
                </div>
                <div class="program-content">
                    <div class="program-header">
                        <span class="program-icon">{{ $program->icon }}</span>
                        <h3 class="program-title">{{ $program->name }}</h3>
                    </div>
                    <p class="program-description">{{ $program->description }}</p>
                    <div class="program-info">
                        <div class="program-meta">
                            <span>👶 {{ $program->age_group }}</span>
                            <span>⏰ {{ $program->duration }}분</span>
                        </div>
                        <div class="program-price">
                            {{ number_format($program->price) }}원<small>/월</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</section>
@endsection
