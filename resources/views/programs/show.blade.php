@extends('layouts.musitory')

@section('content')
<style>
    .program-detail {
        padding: 60px 40px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .program-header {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        margin-bottom: 80px;
    }
    
    .program-image-container {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .program-image-container img {
        width: 100%;
        height: auto;
    }
    
    .program-info {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .program-category {
        color: #FF6B35;
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 10px;
    }
    
    .program-name {
        font-size: 36px;
        font-weight: 700;
        color: #1B1B18;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .program-description {
        font-size: 18px;
        line-height: 1.8;
        color: #706F6C;
        margin-bottom: 30px;
    }
    
    .program-details {
        background: #FDF6F0;
        padding: 30px;
        border-radius: 16px;
        margin-bottom: 30px;
    }
    
    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #FFE8E0;
    }
    
    .detail-item:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        font-weight: 500;
        color: #1B1B18;
    }
    
    .detail-value {
        color: #706F6C;
    }
    
    .price-info {
        background: white;
        border: 2px solid #FF6B35;
        padding: 30px;
        border-radius: 16px;
        text-align: center;
    }
    
    .price-amount {
        font-size: 32px;
        font-weight: 700;
        color: #FF6B35;
        margin-bottom: 10px;
    }
    
    .price-note {
        font-size: 14px;
        color: #706F6C;
    }
    
    .inquiry-button {
        width: 100%;
        padding: 18px;
        background: #FF6B35;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        margin-top: 20px;
        transition: background 0.3s;
    }
    
    .inquiry-button:hover {
        background: #ff5722;
    }
    
    /* 커리큘럼 섹션 */
    .curriculum-section {
        margin-bottom: 80px;
    }
    
    .section-title {
        font-size: 28px;
        font-weight: 700;
        color: #1B1B18;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .curriculum-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }
    
    .curriculum-item {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        text-align: center;
    }
    
    .curriculum-month {
        font-size: 20px;
        font-weight: 600;
        color: #FF6B35;
        margin-bottom: 10px;
    }
    
    .curriculum-content {
        font-size: 15px;
        color: #706F6C;
        line-height: 1.6;
    }
    
    /* 관련 프로그램 */
    .related-programs {
        margin-bottom: 80px;
    }
    
    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
    }
    
    .related-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .related-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }
    
    .related-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .related-icon {
        font-size: 28px;
    }
    
    .related-name {
        font-size: 18px;
        font-weight: 600;
        color: #1B1B18;
    }
    
    .related-info {
        font-size: 14px;
        color: #706F6C;
    }
    
    @media (max-width: 768px) {
        .program-header {
            grid-template-columns: 1fr;
        }
        
        .program-name {
            font-size: 28px;
        }
    }
</style>

<div class="program-detail">
    <div class="program-header">
        <div class="program-image-container">
            <img src="{{ $program->image ?? 'https://via.placeholder.com/600x400' }}" alt="{{ $program->name }}">
        </div>
        
        <div class="program-info">
            <div class="program-category">{{ $program->category }}</div>
            <h1 class="program-name">
                <span>{{ $program->icon }}</span>
                {{ $program->name }}
            </h1>
            <p class="program-description">{{ $program->description }}</p>
            
            <div class="program-details">
                <div class="detail-item">
                    <span class="detail-label">대상 연령</span>
                    <span class="detail-value">{{ $program->age_group }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">수업 시간</span>
                    <span class="detail-value">{{ $program->duration }}분</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">수업 형태</span>
                    <span class="detail-value">1:1 개인 레슨 / 소그룹</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">수업 장소</span>
                    <span class="detail-value">자택 방문 / 센터</span>
                </div>
            </div>
            
            <div class="price-info">
                <div class="price-amount">월 {{ number_format($program->price) }}원</div>
                <div class="price-note">주 1회 기준 / 교재비 별도</div>
            </div>
            
            <button class="inquiry-button" onclick="goToBooking()">예약하기</button>
        </div>
    </div>
    
    <!-- 커리큘럼 섹션 -->
    <section class="curriculum-section">
        <h2 class="section-title">커리큘럼</h2>
        
        <div class="curriculum-grid">
            <div class="curriculum-item">
                <div class="curriculum-month">1~2개월</div>
                <div class="curriculum-content">
                    음악의 기초 요소 탐색<br>
                    리듬과 멜로디 체험
                </div>
            </div>
            <div class="curriculum-item">
                <div class="curriculum-month">3~4개월</div>
                <div class="curriculum-content">
                    음악적 표현력 향상<br>
                    창의적 활동 확대
                </div>
            </div>
            <div class="curriculum-item">
                <div class="curriculum-month">5~6개월</div>
                <div class="curriculum-content">
                    심화 학습 진행<br>
                    개인별 특성 강화
                </div>
            </div>
            <div class="curriculum-item">
                <div class="curriculum-month">7개월~</div>
                <div class="curriculum-content">
                    종합 음악 능력 완성<br>
                    발표회 준비
                </div>
            </div>
        </div>
    </section>
    
    <!-- 관련 프로그램 -->
    @if($relatedPrograms->count() > 0)
    <section class="related-programs">
        <h2 class="section-title">이런 프로그램도 있어요</h2>
        
        <div class="related-grid">
            @foreach($relatedPrograms as $related)
            <div class="related-card" onclick="location.href='{{ route('programs.show', $related->id) }}'">
                <div class="related-header">
                    <span class="related-icon">{{ $related->icon }}</span>
                    <h3 class="related-name">{{ $related->name }}</h3>
                </div>
                <div class="related-info">
                    {{ $related->age_group }} · {{ $related->duration }}분 · 월 {{ number_format($related->price) }}원
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>

<script>
function goToBooking() {
    // 로그인 여부 확인
    @auth
        window.location.href = '{{ route('bookings.create', $program->id) }}';
    @else
        if (confirm('예약하려면 로그인이 필요합니다. 로그인 페이지로 이동하시겠습니까?')) {
            window.location.href = '{{ route('login') }}?redirect={{ route('bookings.create', $program->id) }}';
        }
    @endauth
}

function scrollToInquiry() {
    // 모바일인지 확인
    if (window.innerWidth <= 768) {
        // 모바일: 문의 모달 열기
        openInquiryModal();
        
        // 모바일 프로그램 선택
        setTimeout(() => {
            const mobileProgramSelect = document.getElementById('mobile_program_id');
            if (mobileProgramSelect) {
                mobileProgramSelect.value = '{{ $program->id }}';
            }
        }, 100);
    } else {
        // 데스크톱: 좌측 패널의 문의 폼으로 스크롤
        const inquiryForm = document.querySelector('.inquiry-form');
        if (inquiryForm) {
            inquiryForm.scrollIntoView({ behavior: 'smooth' });
            
            // 프로그램 선택
            const programSelect = document.getElementById('program_id');
            if (programSelect) {
                programSelect.value = '{{ $program->id }}';
            }
        }
    }
}
</script>
@endsection
