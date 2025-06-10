@extends('layouts.musitory')

@section('content')
<style>
    .teachers-hero {
        background: linear-gradient(135deg, #FDF6F0 0%, #FFE8E0 100%);
        padding: 60px 40px;
        text-align: center;
    }
    
    .teachers-hero h1 {
        font-size: 42px;
        font-weight: 700;
        color: #1B1B18;
        margin-bottom: 15px;
    }
    
    .teachers-section {
        padding: 60px 40px;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .filter-section {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 40px;
    }
    
    .filter-row {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .filter-group {
        flex: 1;
        min-width: 200px;
    }
    
    .filter-label {
        font-size: 14px;
        font-weight: 500;
        color: #1B1B18;
        margin-bottom: 8px;
        display: block;
    }
    
    .filter-select {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #E3E3E0;
        border-radius: 8px;
        font-size: 14px;
        font-family: 'Noto Sans KR', sans-serif;
    }
    
    .teachers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
    }
    
    .teacher-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .teacher-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }
    
    .teacher-header {
        padding: 30px 30px 20px;
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }
    
    .teacher-photo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #FDF6F0;
    }
    
    .teacher-info {
        flex: 1;
    }
    
    .teacher-name {
        font-size: 20px;
        font-weight: 600;
        color: #1B1B18;
        margin-bottom: 5px;
    }
    
    .teacher-location {
        font-size: 14px;
        color: #706F6C;
        margin-bottom: 10px;
    }
    
    .teacher-rating {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }
    
    .rating-stars {
        color: #FFD700;
    }
    
    .rating-count {
        color: #706F6C;
    }
    
    .teacher-specialties {
        padding: 0 30px 20px;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .specialty-tag {
        background: #FDF6F0;
        color: #FF6B35;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
    }
    
    .teacher-bio {
        padding: 0 30px 20px;
        font-size: 14px;
        line-height: 1.6;
        color: #706F6C;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .teacher-stats {
        background: #f8f9fa;
        padding: 20px 30px;
        display: flex;
        justify-content: space-around;
        border-top: 1px solid #E3E3E0;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-value {
        font-size: 18px;
        font-weight: 600;
        color: #1B1B18;
        display: block;
    }
    
    .stat-label {
        font-size: 12px;
        color: #706F6C;
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
        .teachers-hero h1 {
            font-size: 32px;
        }
        
        .teachers-grid {
            grid-template-columns: 1fr;
        }
        
        .filter-row {
            flex-direction: column;
        }
        
        .filter-group {
            width: 100%;
        }
    }
</style>

<div class="teachers-hero">
    <h1>뮤지토리 선생님</h1>
    <p>검증된 전문가들이 아이의 음악 여정을 함께합니다</p>
</div>

<section class="teachers-section">
    <div class="filter-section">
        <div class="filter-row">
            <div class="filter-group">
                <label class="filter-label">전문 분야</label>
                <select class="filter-select" id="specialtyFilter">
                    <option value="">전체</option>
                    <option value="음악동화">음악동화</option>
                    <option value="피아노">피아노</option>
                    <option value="성악">성악</option>
                    <option value="뮤지컬">뮤지컬</option>
                    <option value="바이올린">바이올린</option>
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label">지역</label>
                <select class="filter-select" id="locationFilter">
                    <option value="">전체</option>
                    <option value="서울">서울</option>
                    <option value="경기">경기</option>
                    <option value="인천">인천</option>
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label">정렬</label>
                <select class="filter-select" id="sortFilter">
                    <option value="rating">평점 높은순</option>
                    <option value="reviews">리뷰 많은순</option>
                    <option value="lessons">수업 많은순</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="teachers-grid">
        @foreach($teachers as $teacher)
        <div class="teacher-card" onclick="location.href='{{ route('teachers.show', $teacher->id) }}'">
            <div class="teacher-header">
                <img src="{{ $teacher->photo ?? 'https://via.placeholder.com/80' }}" alt="{{ $teacher->name }}" class="teacher-photo">
                <div class="teacher-info">
                    <h3 class="teacher-name">{{ $teacher->name }} 선생님</h3>
                    <p class="teacher-location">📍 {{ $teacher->location }}</p>
                    <div class="teacher-rating">
                        <span class="rating-stars">
                            @for($i = 0; $i < floor($teacher->rating); $i++)
                                ★
                            @endfor
                            @if($teacher->rating - floor($teacher->rating) >= 0.5)
                                ☆
                            @endif
                        </span>
                        <span>{{ $teacher->rating }}</span>
                        <span class="rating-count">({{ $teacher->review_count }})</span>
                    </div>
                </div>
            </div>
            
            <div class="teacher-specialties">
                @foreach($teacher->specialties as $specialty)
                    <span class="specialty-tag">{{ $specialty }}</span>
                @endforeach
            </div>
            
            <p class="teacher-bio">{{ $teacher->bio }}</p>
            
            <div class="teacher-stats">
                <div class="stat-item">
                    <span class="stat-value">{{ $teacher->lesson_count }}</span>
                    <span class="stat-label">총 수업</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">{{ $teacher->review_count }}</span>
                    <span class="stat-label">리뷰</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">98%</span>
                    <span class="stat-label">만족도</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- 페이지네이션 -->
    <div class="pagination">
        {{ $teachers->links() }}
    </div>
</section>

<script>
// 필터링 기능 (간단한 예시)
document.getElementById('specialtyFilter').addEventListener('change', function() {
    // 실제로는 AJAX로 필터링된 결과를 가져와야 합니다
    const specialty = this.value;
    if (specialty) {
        window.location.href = `{{ route('teachers.index') }}?specialty=${specialty}`;
    }
});

document.getElementById('locationFilter').addEventListener('change', function() {
    const location = this.value;
    if (location) {
        window.location.href = `{{ route('teachers.index') }}?location=${location}`;
    }
});

document.getElementById('sortFilter').addEventListener('change', function() {
    const sort = this.value;
    window.location.href = `{{ route('teachers.index') }}?sort=${sort}`;
});
</script>
@endsection
