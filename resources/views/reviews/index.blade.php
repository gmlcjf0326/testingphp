@extends('layouts.musitory')

@section('content')
<style>
    .reviews-hero {
        background: linear-gradient(135deg, #FDF6F0 0%, #FFE8E0 100%);
        padding: 60px 40px;
        text-align: center;
    }
    
    .reviews-hero h1 {
        font-size: 42px;
        font-weight: 700;
        color: #1B1B18;
        margin-bottom: 15px;
    }
    
    .reviews-section {
        padding: 60px 40px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .stats-section {
        display: flex;
        justify-content: center;
        gap: 60px;
        margin-bottom: 60px;
    }
    
    .stat-card {
        text-align: center;
        background: white;
        padding: 30px 40px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    .stat-number {
        font-size: 48px;
        font-weight: 700;
        color: #FF6B35;
        display: block;
    }
    
    .stat-label {
        font-size: 16px;
        color: #706F6C;
    }
    
    .filter-bar {
        background: white;
        padding: 20px 30px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 40px;
        display: flex;
        gap: 20px;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .filter-item {
        flex: 1;
        min-width: 200px;
    }
    
    .filter-label {
        font-size: 14px;
        font-weight: 500;
        color: #1B1B18;
        display: block;
        margin-bottom: 5px;
    }
    
    .filter-select {
        width: 100%;
        padding: 8px 15px;
        border: 1px solid #E3E3E0;
        border-radius: 8px;
        font-size: 14px;
    }
    
    .reviews-grid {
        display: grid;
        gap: 30px;
    }
    
    .review-card {
        background: white;
        border-radius: 16px;
        padding: 35px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s;
    }
    
    .review-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }
    
    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }
    
    .review-teacher {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .teacher-photo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .teacher-info h3 {
        font-size: 18px;
        font-weight: 600;
        color: #1B1B18;
        margin-bottom: 5px;
    }
    
    .teacher-info p {
        font-size: 14px;
        color: #706F6C;
    }
    
    .review-rating {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .rating-stars {
        color: #FFD700;
        font-size: 18px;
    }
    
    .rating-text {
        font-size: 14px;
        color: #706F6C;
    }
    
    .review-content {
        font-size: 15px;
        line-height: 1.8;
        color: #1B1B18;
        margin-bottom: 20px;
    }
    
    .review-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        border-top: 1px solid #E3E3E0;
    }
    
    .review-author {
        font-size: 14px;
        color: #706F6C;
    }
    
    .review-date {
        font-size: 14px;
        color: #706F6C;
    }
    
    .highlight-box {
        background: #FDF6F0;
        border-left: 4px solid #FF6B35;
        padding: 20px 30px;
        margin: 40px 0;
        border-radius: 8px;
    }
    
    .highlight-box h3 {
        font-size: 20px;
        color: #FF6B35;
        margin-bottom: 10px;
    }
    
    .highlight-box p {
        font-size: 15px;
        line-height: 1.6;
        color: #1B1B18;
    }
    
    /* 페이지네이션 */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 60px;
    }
    
    .pagination a,
    .pagination span {
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        color: #706F6C;
        transition: all 0.3s;
    }
    
    .pagination a:hover {
        background: #FDF6F0;
        color: #FF6B35;
    }
    
    .pagination .active {
        background: #FF6B35;
        color: white;
    }
    
    @media (max-width: 768px) {
        .reviews-hero h1 {
            font-size: 32px;
        }
        
        .stats-section {
            flex-direction: column;
            gap: 20px;
        }
        
        .filter-bar {
            flex-direction: column;
        }
        
        .filter-item {
            width: 100%;
        }
        
        .review-header {
            flex-direction: column;
            gap: 15px;
        }
    }
</style>

<div class="reviews-hero">
    <h1>수업 후기</h1>
    <p>뮤지토리와 함께한 학부모님들의 생생한 이야기</p>
</div>

<section class="reviews-section">
    <div class="stats-section">
        <div class="stat-card">
            <span class="stat-number">{{ $reviews->total() }}</span>
            <span class="stat-label">전체 후기</span>
        </div>
        <div class="stat-card">
            <span class="stat-number">4.9</span>
            <span class="stat-label">평균 평점</span>
        </div>
        <div class="stat-card">
            <span class="stat-number">98%</span>
            <span class="stat-label">만족도</span>
        </div>
    </div>
    
    <div class="filter-bar">
        <div class="filter-item">
            <label class="filter-label">프로그램</label>
            <select class="filter-select" id="programFilter">
                <option value="">전체</option>
                <option value="음악동화">음악동화</option>
                <option value="피아노">피아노</option>
                <option value="성악">성악</option>
                <option value="뮤지컬">뮤지컬</option>
            </select>
        </div>
        <div class="filter-item">
            <label class="filter-label">평점</label>
            <select class="filter-select" id="ratingFilter">
                <option value="">전체</option>
                <option value="5">5점</option>
                <option value="4">4점 이상</option>
            </select>
        </div>
        <div class="filter-item">
            <label class="filter-label">정렬</label>
            <select class="filter-select" id="sortFilter">
                <option value="latest">최신순</option>
                <option value="rating">평점 높은순</option>
            </select>
        </div>
    </div>
    
    <div class="highlight-box">
        <h3>💝 뮤지토리를 선택한 이유</h3>
        <p>
            "아이의 음악적 재능을 발견하고 키워주는 뮤지토리의 특별한 교육 방법 덕분에 
            우리 아이가 음악을 진정으로 사랑하게 되었어요."
        </p>
    </div>
    
    <div class="reviews-grid">
        @foreach($reviews as $review)
        <div class="review-card">
            <div class="review-header">
                <div class="review-teacher">
                    <img src="{{ $review->teacher->photo ?? 'https://via.placeholder.com/50' }}" 
                         alt="{{ $review->teacher->name }}" 
                         class="teacher-photo">
                    <div class="teacher-info">
                        <h3>{{ $review->teacher->name }} 선생님</h3>
                        @if($review->program)
                            <p>{{ $review->program->name }}</p>
                        @endif
                    </div>
                </div>
                <div class="review-rating">
                    <span class="rating-stars">
                        @for($i = 0; $i < $review->rating; $i++)
                            ★
                        @endfor
                    </span>
                    <span class="rating-text">{{ $review->rating }}.0</span>
                </div>
            </div>
            
            <div class="review-content">
                {{ $review->content }}
            </div>
            
            <div class="review-footer">
                <div class="review-author">
                    {{ $review->parent_name }} 학부모님 · {{ $review->child_name }} ({{ $review->child_age }}세)
                </div>
                <div class="review-date">
                    {{ $review->created_at->format('Y년 m월 d일') }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- 페이지네이션 -->
    <div class="pagination">
        {{ $reviews->links() }}
    </div>
    
    <div class="highlight-box" style="margin-top: 60px;">
        <h3>✍️ 후기를 남기고 싶으신가요?</h3>
        <p>
            뮤지토리 수업을 경험하신 학부모님께서는 마이페이지에서 후기를 작성하실 수 있습니다.
            소중한 의견을 들려주세요!
        </p>
    </div>
</section>

<script>
// 필터링 기능
document.getElementById('programFilter').addEventListener('change', function() {
    applyFilters();
});

document.getElementById('ratingFilter').addEventListener('change', function() {
    applyFilters();
});

document.getElementById('sortFilter').addEventListener('change', function() {
    applyFilters();
});

function applyFilters() {
    const program = document.getElementById('programFilter').value;
    const rating = document.getElementById('ratingFilter').value;
    const sort = document.getElementById('sortFilter').value;
    
    let url = '{{ route('reviews.index') }}?';
    if (program) url += `program=${program}&`;
    if (rating) url += `rating=${rating}&`;
    if (sort) url += `sort=${sort}`;
    
    window.location.href = url;
}
</script>
@endsection
