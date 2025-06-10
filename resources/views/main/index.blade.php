@extends('layouts.musitory')

@section('content')
<style>
    /* 히어로 섹션 */
    .hero {
        background: linear-gradient(135deg, #FDF6F0 0%, #FFE8E0 100%);
        padding: 80px 40px;
        text-align: center;
    }
    
    .hero h1 {
        font-size: 48px;
        font-weight: 700;
        color: #1B1B18;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    
    .hero p {
        font-size: 20px;
        color: #706F6C;
        margin-bottom: 40px;
    }
    
    /* 프로그램 카테고리 */
    .program-categories {
        display: flex;
        gap: 30px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .category-card {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        width: 150px;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }
    
    .category-icon {
        font-size: 48px;
        margin-bottom: 15px;
    }
    
    .category-name {
        font-size: 16px;
        font-weight: 500;
        color: #1B1B18;
    }
    
    /* 섹션 스타일 */
    .section {
        padding: 80px 40px;
    }
    
    .section-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 40px;
        text-align: center;
    }
    
    /* 선생님 섹션 */
    .teachers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }
    
    .teacher-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s;
    }
    
    .teacher-card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
    }
    
    .teacher-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .teacher-photo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
    }
    
    .teacher-info h3 {
        font-size: 18px;
        margin-bottom: 5px;
    }
    
    .teacher-info p {
        font-size: 14px;
        color: #706F6C;
    }
    
    .teacher-specialties {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }
    
    .specialty-tag {
        background: #FDF6F0;
        color: #FF6B35;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
    }
    
    .teacher-stats {
        display: flex;
        gap: 20px;
        font-size: 14px;
        color: #706F6C;
    }
    
    /* 리뷰 섹션 */
    .reviews-carousel {
        position: relative;
        overflow: hidden;
        padding: 20px 0;
    }
    
    .reviews-container {
        display: flex;
        gap: 20px;
        transition: transform 0.5s ease;
    }
    
    .review-card {
        min-width: 350px;
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    
    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .review-rating {
        color: #FFD700;
    }
    
    .review-content {
        font-size: 14px;
        line-height: 1.8;
        color: #1B1B18;
        margin-bottom: 15px;
    }
    
    .review-footer {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #706F6C;
    }
    
    /* FAQ 섹션 */
    .faq-list {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .faq-item {
        background: white;
        border-radius: 12px;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    
    .faq-question {
        padding: 20px 30px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 500;
    }
    
    .faq-question:hover {
        background: #f8f9fa;
    }
    
    .faq-answer {
        padding: 0 30px 20px;
        display: none;
        color: #706F6C;
    }
    
    .faq-item.active .faq-answer {
        display: block;
    }
    
    /* 회사 소개 섹션 */
    .about-section {
        background: #FDF6F0;
        text-align: center;
    }
    
    .about-content {
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.8;
    }
    
    .about-stats {
        display: flex;
        justify-content: center;
        gap: 60px;
        margin-top: 40px;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        font-size: 36px;
        font-weight: 700;
        color: #FF6B35;
    }
    
    .stat-label {
        font-size: 14px;
        color: #706F6C;
    }
    
    /* 반응형 */
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 32px;
        }
        
        .hero p {
            font-size: 16px;
        }
        
        .section {
            padding: 40px 20px;
        }
        
        .teachers-grid {
            grid-template-columns: 1fr;
        }
        
        .review-card {
            min-width: 300px;
        }
        
        .about-stats {
            gap: 30px;
        }
    }
</style>

<!-- 히어로 섹션 -->
<section class="hero">
    <h1>음악과 이야기가 만나는<br>특별한 순간, 뮤지토리</h1>
    <p>아이의 창의력과 감성을 키우는 프리미엄 음악 교육</p>
    
    <div class="program-categories">
        <div class="category-card" onclick="location.href='{{ route('programs.index') }}'">
            <div class="category-icon">🎵</div>
            <div class="category-name">음악동화</div>
        </div>
        <div class="category-card" onclick="location.href='{{ route('programs.index') }}'">
            <div class="category-icon">🎹</div>
            <div class="category-name">피아노</div>
        </div>
        <div class="category-card" onclick="location.href='{{ route('programs.index') }}'">
            <div class="category-icon">🎤</div>
            <div class="category-name">성악</div>
        </div>
        <div class="category-card" onclick="location.href='{{ route('programs.index') }}'">
            <div class="category-icon">🎭</div>
            <div class="category-name">뮤지컬</div>
        </div>
        <div class="category-card" onclick="location.href='{{ route('programs.index') }}'">
            <div class="category-icon">🎻</div>
            <div class="category-name">기악</div>
        </div>
    </div>
</section>

<!-- 우수 선생님 섹션 -->
<section class="section">
    <h2 class="section-title">지금 가장 <span style="color: #FF6B35;">활발한</span> 뮤지토리 선생님</h2>
    
    <div class="teachers-grid">
        @foreach($teachers as $teacher)
        <div class="teacher-card" onclick="location.href='{{ route('teachers.show', $teacher->id) }}'">
            <div class="teacher-header">
                <img src="{{ $teacher->photo ?? 'https://via.placeholder.com/60' }}" alt="{{ $teacher->name }}" class="teacher-photo">
                <div class="teacher-info">
                    <h3>{{ $teacher->name }} 선생님</h3>
                    <p>{{ $teacher->location }}</p>
                </div>
            </div>
            <div class="teacher-specialties">
                @foreach($teacher->specialties as $specialty)
                    <span class="specialty-tag">{{ $specialty }}</span>
                @endforeach
            </div>
            <div class="teacher-stats">
                <span>⭐ {{ $teacher->rating }}</span>
                <span>리뷰 {{ $teacher->review_count }}개</span>
                <span>수업 {{ $teacher->lesson_count }}회</span>
            </div>
        </div>
        @endforeach
    </div>
    
    <div style="text-align: center; margin-top: 40px;">
        <a href="{{ route('teachers.index') }}" style="color: #FF6B35; text-decoration: none; font-weight: 500;">
            모든 선생님 보기 →
        </a>
    </div>
</section>

<!-- 리뷰 섹션 -->
<section class="section" style="background: #f8f9fa;">
    <h2 class="section-title">학부모님들의 <span style="color: #FF6B35;">생생한</span> 후기</h2>
    
    <div class="reviews-carousel">
        <div class="reviews-container" id="reviewsContainer">
            @foreach($reviews as $review)
            <div class="review-card">
                <div class="review-header">
                    <div>
                        <strong>{{ $review->teacher->name }} 선생님</strong>
                        @if($review->program)
                            <span style="color: #706F6C; font-size: 12px;"> · {{ $review->program->name }}</span>
                        @endif
                    </div>
                    <div class="review-rating">
                        @for($i = 0; $i < $review->rating; $i++)
                            ★
                        @endfor
                    </div>
                </div>
                <div class="review-content">
                    {{ $review->content }}
                </div>
                <div class="review-footer">
                    <span>{{ $review->parent_name }} 학부모님</span>
                    <span>{{ $review->time_ago }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- FAQ 섹션 -->
<section class="section">
    <h2 class="section-title">자주 묻는 질문</h2>
    
    <div class="faq-list">
        <div class="faq-item">
            <div class="faq-question">
                <span>뮤지토리는 어떤 교육 프로그램인가요?</span>
                <span>+</span>
            </div>
            <div class="faq-answer">
                뮤지토리는 음악(Music)과 이야기(Story)를 결합한 창의적인 음악 교육 프로그램입니다. 
                동화를 통해 음악을 배우며 아이들의 상상력과 음악적 감수성을 동시에 키워나갑니다.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                <span>수업은 어떻게 진행되나요?</span>
                <span>+</span>
            </div>
            <div class="faq-answer">
                전문 교육을 받은 뮤지토리 선생님이 직접 방문하여 1:1 또는 소그룹으로 수업을 진행합니다. 
                아이의 수준과 흥미에 맞춘 맞춤형 커리큘럼으로 진행되며, 매 수업 후 학부모님께 상세한 피드백을 제공합니다.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                <span>수업료는 어떻게 되나요?</span>
                <span>+</span>
            </div>
            <div class="faq-answer">
                프로그램별로 수업료가 다르며, 주 1회 기준 월 8만원부터 18만원까지 다양합니다. 
                자세한 수업료는 상담을 통해 안내드리며, 형제 할인 등 다양한 혜택도 준비되어 있습니다.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                <span>수업 가능 지역은 어디인가요?</span>
                <span>+</span>
            </div>
            <div class="faq-answer">
                현재 서울, 경기, 인천 지역에서 수업이 가능하며, 점차 전국으로 확대해 나가고 있습니다. 
                거주 지역의 수업 가능 여부는 문의 주시면 자세히 안내드리겠습니다.
            </div>
        </div>
    </div>
</section>

<!-- 회사 소개 섹션 -->
<section class="section about-section">
    <h2 class="section-title">뮤지토리 이야기</h2>
    
    <div class="about-content">
        <p>
            2009년 프랑스 파리에서 시작된 뮤지토리는<br>
            동화와 음악을 접목한 혁신적인 교육 방법으로<br>
            수많은 아이들의 음악적 잠재력을 깨워왔습니다.
        </p>
        
        <div class="about-stats">
            <div class="stat-item">
                <div class="stat-number">15</div>
                <div class="stat-label">년의 역사</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">5,000+</div>
                <div class="stat-label">누적 수강생</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">98%</div>
                <div class="stat-label">학부모 만족도</div>
            </div>
        </div>
    </div>
</section>

<script>
// FAQ 토글
document.querySelectorAll('.faq-question').forEach(item => {
    item.addEventListener('click', () => {
        const parent = item.parentElement;
        parent.classList.toggle('active');
        
        // 다른 FAQ 닫기
        document.querySelectorAll('.faq-item').forEach(faq => {
            if (faq !== parent) {
                faq.classList.remove('active');
            }
        });
    });
});

// 리뷰 자동 슬라이드 (선택사항)
let reviewIndex = 0;
const reviewsContainer = document.getElementById('reviewsContainer');
const totalReviews = {{ count($reviews) }};

function slideReviews() {
    reviewIndex = (reviewIndex + 1) % totalReviews;
    const offset = reviewIndex * 370; // 350px + 20px gap
    reviewsContainer.style.transform = `translateX(-${offset}px)`;
}

// 5초마다 자동 슬라이드
setInterval(slideReviews, 5000);
</script>
@endsection
