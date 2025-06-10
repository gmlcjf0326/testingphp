@extends('layouts.musitory')

@section('content')
<style>
    .teacher-detail {
        padding: 60px 40px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .teacher-profile {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }
    
    .profile-header {
        display: flex;
        gap: 40px;
        margin-bottom: 40px;
        align-items: flex-start;
    }
    
    .profile-photo {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #FDF6F0;
    }
    
    .profile-info {
        flex: 1;
    }
    
    .teacher-name {
        font-size: 36px;
        font-weight: 700;
        color: #1B1B18;
        margin-bottom: 10px;
    }
    
    .teacher-location {
        font-size: 18px;
        color: #706F6C;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .teacher-rating-section {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .rating-display {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .rating-stars {
        color: #FFD700;
        font-size: 24px;
    }
    
    .rating-number {
        font-size: 24px;
        font-weight: 600;
        color: #1B1B18;
    }
    
    .review-count {
        color: #706F6C;
        font-size: 16px;
    }
    
    .teacher-specialties {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .specialty-badge {
        background: #FF6B35;
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 15px;
        font-weight: 500;
    }
    
    .teacher-stats {
        display: flex;
        gap: 40px;
        padding: 30px;
        background: #f8f9fa;
        border-radius: 16px;
        justify-content: space-around;
    }
    
    .stat-box {
        text-align: center;
    }
    
    .stat-number {
        font-size: 32px;
        font-weight: 700;
        color: #FF6B35;
        display: block;
    }
    
    .stat-title {
        font-size: 14px;
        color: #706F6C;
    }
    
    /* 탭 메뉴 */
    .tab-menu {
        display: flex;
        gap: 30px;
        border-bottom: 2px solid #E3E3E0;
        margin-bottom: 40px;
    }
    
    .tab-item {
        padding: 15px 0;
        font-size: 18px;
        font-weight: 500;
        color: #706F6C;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        transition: all 0.3s;
    }
    
    .tab-item.active {
        color: #FF6B35;
        border-bottom-color: #FF6B35;
    }
    
    .tab-content {
        display: none;
    }
    
    .tab-content.active {
        display: block;
    }
    
    /* 소개 섹션 */
    .bio-section {
        line-height: 1.8;
        font-size: 16px;
        color: #1B1B18;
        margin-bottom: 40px;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }
    
    .info-card {
        background: #FDF6F0;
        padding: 30px;
        border-radius: 16px;
    }
    
    .info-card h3 {
        font-size: 20px;
        font-weight: 600;
        color: #1B1B18;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .info-list {
        list-style: none;
    }
    
    .info-list li {
        padding: 10px 0;
        color: #706F6C;
        border-bottom: 1px solid #FFE8E0;
    }
    
    .info-list li:last-child {
        border-bottom: none;
    }
    
    /* 리뷰 섹션 */
    .reviews-section {
        margin-top: 40px;
    }
    
    .review-item {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }
    
    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .review-author {
        font-weight: 600;
        color: #1B1B18;
    }
    
    .review-meta {
        font-size: 14px;
        color: #706F6C;
    }
    
    .review-rating {
        color: #FFD700;
    }
    
    .review-content {
        line-height: 1.6;
        color: #1B1B18;
    }
    
    .review-footer {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
        font-size: 13px;
        color: #706F6C;
    }
    
    .inquiry-cta {
        background: linear-gradient(135deg, #FF6B35 0%, #ff5722 100%);
        color: white;
        padding: 30px;
        border-radius: 16px;
        text-align: center;
        margin-top: 40px;
    }
    
    .cta-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .cta-button {
        background: white;
        color: #FF6B35;
        padding: 15px 40px;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        margin-top: 20px;
        transition: transform 0.3s;
    }
    
    .cta-button:hover {
        transform: scale(1.05);
    }
    
    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .teacher-stats {
            flex-direction: column;
            gap: 20px;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="teacher-detail">
    <div class="teacher-profile">
        <div class="profile-header">
            <img src="{{ $teacher->photo ?? 'https://via.placeholder.com/200' }}" alt="{{ $teacher->name }}" class="profile-photo">
            
            <div class="profile-info">
                <h1 class="teacher-name">{{ $teacher->name }} 선생님</h1>
                <p class="teacher-location">📍 {{ $teacher->location }}</p>
                
                <div class="teacher-rating-section">
                    <div class="rating-display">
                        <span class="rating-stars">
                            @for($i = 0; $i < floor($teacher->rating); $i++)
                                ★
                            @endfor
                            @if($teacher->rating - floor($teacher->rating) >= 0.5)
                                ☆
                            @endif
                        </span>
                        <span class="rating-number">{{ $teacher->rating }}</span>
                    </div>
                    <span class="review-count">리뷰 {{ $teacher->review_count }}개</span>
                </div>
                
                <div class="teacher-specialties">
                    @foreach($teacher->specialties as $specialty)
                        <span class="specialty-badge">{{ $specialty }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="teacher-stats">
            <div class="stat-box">
                <span class="stat-number">{{ $teacher->lesson_count }}</span>
                <span class="stat-title">총 수업 횟수</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ $teacher->review_count }}</span>
                <span class="stat-title">수업 후기</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">98%</span>
                <span class="stat-title">재수강률</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ floor($teacher->lesson_count / 12) }}+</span>
                <span class="stat-title">수강생 수</span>
            </div>
        </div>
    </div>
    
    <!-- 탭 메뉴 -->
    <div class="tab-menu">
        <div class="tab-item active" onclick="showTab('intro')">선생님 소개</div>
        <div class="tab-item" onclick="showTab('reviews')">수업 후기</div>
    </div>
    
    <!-- 소개 탭 -->
    <div id="intro-tab" class="tab-content active">
        <div class="bio-section">
            <p>{{ $teacher->bio }}</p>
        </div>
        
        <div class="info-grid">
            <div class="info-card">
                <h3>🎓 학력 사항</h3>
                <ul class="info-list">
                    @foreach($teacher->education as $edu)
                        <li>{{ $edu }}</li>
                    @endforeach
                </ul>
            </div>
            
            <div class="info-card">
                <h3>💼 경력 사항</h3>
                <ul class="info-list">
                    @foreach($teacher->experience as $exp)
                        <li>{{ $exp }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
    <!-- 리뷰 탭 -->
    <div id="reviews-tab" class="tab-content">
        <div class="reviews-section">
            @forelse($teacher->approvedReviews as $review)
            <div class="review-item">
                <div class="review-header">
                    <div>
                        <span class="review-author">{{ $review->parent_name }} 학부모님</span>
                        @if($review->program)
                            <span class="review-meta"> · {{ $review->program->name }}</span>
                        @endif
                    </div>
                    <span class="review-rating">
                        @for($i = 0; $i < $review->rating; $i++)
                            ★
                        @endfor
                    </span>
                </div>
                <p class="review-content">{{ $review->content }}</p>
                <div class="review-footer">
                    <span>{{ $review->child_name }} ({{ $review->child_age }}세)</span>
                    <span>{{ $review->created_at->format('Y.m.d') }}</span>
                </div>
            </div>
            @empty
            <p style="text-align: center; color: #706F6C; padding: 40px;">아직 등록된 후기가 없습니다.</p>
            @endforelse
        </div>
    </div>
    
    <!-- 문의 CTA -->
    <div class="inquiry-cta">
        <h2 class="cta-title">{{ $teacher->name }} 선생님과 함께하고 싶으신가요?</h2>
        <p>지금 바로 문의하시면 빠른 시일 내에 연락드리겠습니다.</p>
        <button class="cta-button" onclick="scrollToInquiry()">수업 문의하기</button>
    </div>
</div>

<script>
function showTab(tabName) {
    // 모든 탭 컨텐츠 숨기기
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // 모든 탭 메뉴 비활성화
    document.querySelectorAll('.tab-item').forEach(item => {
        item.classList.remove('active');
    });
    
    // 선택된 탭 활성화
    document.getElementById(tabName + '-tab').classList.add('active');
    event.target.classList.add('active');
}

function scrollToInquiry() {
    // 좌측 패널의 문의 폼으로 스크롤
    const inquiryForm = document.querySelector('.inquiry-form');
    if (inquiryForm) {
        inquiryForm.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>
@endsection
