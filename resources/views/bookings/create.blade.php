@extends('layouts.musitory')

@section('content')
<style>
    .booking-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    
    .booking-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .booking-title {
        font-size: 32px;
        font-weight: 700;
        color: #1B1B18;
        margin-bottom: 10px;
    }
    
    .booking-subtitle {
        font-size: 18px;
        color: #706F6C;
    }
    
    .program-info-card {
        background: #FDF6F0;
        padding: 30px;
        border-radius: 16px;
        margin-bottom: 30px;
    }
    
    .program-info-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .program-icon {
        font-size: 36px;
    }
    
    .program-details {
        flex: 1;
    }
    
    .program-name {
        font-size: 24px;
        font-weight: 600;
        color: #1B1B18;
        margin-bottom: 5px;
    }
    
    .program-meta {
        display: flex;
        gap: 20px;
        color: #706F6C;
        font-size: 15px;
    }
    
    .booking-form {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    .form-section {
        margin-bottom: 40px;
    }
    
    .section-title {
        font-size: 20px;
        font-weight: 600;
        color: #1B1B18;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #FFE8E0;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #1B1B18;
        margin-bottom: 8px;
    }
    
    .form-group .required {
        color: #FF6B35;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #E3E3E0;
        border-radius: 8px;
        font-size: 15px;
        font-family: 'Noto Sans KR', sans-serif;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #FF6B35;
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
    }
    
    .teacher-select {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .teacher-option {
        padding: 15px;
        border: 2px solid #E3E3E0;
        border-radius: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .teacher-option:hover {
        border-color: #FF6B35;
        background: #FFF8F5;
    }
    
    .teacher-option.selected {
        border-color: #FF6B35;
        background: #FFF8F5;
    }
    
    .teacher-photo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin: 0 auto 10px;
        object-fit: cover;
    }
    
    .teacher-name {
        font-weight: 500;
        color: #1B1B18;
        margin-bottom: 5px;
    }
    
    .teacher-specialty {
        font-size: 13px;
        color: #706F6C;
    }
    
    .date-picker {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .date-option {
        padding: 15px 10px;
        border: 1px solid #E3E3E0;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .date-option:hover:not(.disabled) {
        border-color: #FF6B35;
        background: #FFF8F5;
    }
    
    .date-option.selected {
        border-color: #FF6B35;
        background: #FF6B35;
        color: white;
    }
    
    .date-option.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .time-slots {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .time-slot {
        padding: 12px;
        border: 1px solid #E3E3E0;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
    }
    
    .time-slot:hover:not(.disabled) {
        border-color: #FF6B35;
        background: #FFF8F5;
    }
    
    .time-slot.selected {
        border-color: #FF6B35;
        background: #FF6B35;
        color: white;
    }
    
    .time-slot.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: #F5F5F5;
    }
    
    .price-summary {
        background: #FDF6F0;
        padding: 25px;
        border-radius: 12px;
        margin-top: 30px;
    }
    
    .price-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 15px;
    }
    
    .price-total {
        display: flex;
        justify-content: space-between;
        font-size: 20px;
        font-weight: 600;
        color: #FF6B35;
        padding-top: 15px;
        border-top: 1px solid #FFE8E0;
    }
    
    .booking-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }
    
    .btn-cancel {
        flex: 1;
        padding: 16px;
        background: white;
        color: #706F6C;
        border: 1px solid #E3E3E0;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        text-decoration: none;
    }
    
    .btn-cancel:hover {
        background: #F5F5F5;
    }
    
    .btn-submit {
        flex: 2;
        padding: 16px;
        background: #FF6B35;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-submit:hover {
        background: #ff5722;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
    }
    
    .btn-submit:disabled {
        background: #E3E3E0;
        cursor: not-allowed;
        transform: none;
    }
    
    .loading-spinner {
        display: none;
        text-align: center;
        padding: 20px;
    }
    
    .loading-spinner.active {
        display: block;
    }
    
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .teacher-select {
            grid-template-columns: 1fr;
        }
        
        .booking-form {
            padding: 20px;
        }
    }
</style>

<div class="booking-container">
    <div class="booking-header">
        <h1 class="booking-title">수업 예약하기</h1>
        <p class="booking-subtitle">원하시는 날짜와 시간을 선택해주세요</p>
    </div>
    
    <!-- 프로그램 정보 -->
    <div class="program-info-card">
        <div class="program-info-header">
            <span class="program-icon">{{ $program->icon }}</span>
            <div class="program-details">
                <h2 class="program-name">{{ $program->name }}</h2>
                <div class="program-meta">
                    <span>{{ $program->age_group }}</span>
                    <span>•</span>
                    <span>{{ $program->duration }}분</span>
                    <span>•</span>
                    <span>월 {{ number_format($program->price) }}원</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- 예약 폼 -->
    <form action="{{ route('bookings.store') }}" method="POST" class="booking-form">
        @csrf
        <input type="hidden" name="program_id" value="{{ $program->id }}">
        
        <!-- 선생님 선택 -->
        <div class="form-section">
            <h3 class="section-title">선생님 선택 (선택사항)</h3>
            <div class="teacher-select">
                <div class="teacher-option" data-teacher-id="">
                    <div style="width: 60px; height: 60px; border-radius: 50%; background: #E3E3E0; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user" style="font-size: 24px; color: #706F6C;"></i>
                    </div>
                    <div class="teacher-name">무관</div>
                    <div class="teacher-specialty">선생님 무관</div>
                </div>
                @foreach($teachers as $teacher)
                <div class="teacher-option" data-teacher-id="{{ $teacher->id }}">
                    <img src="{{ $teacher->photo ?? 'https://via.placeholder.com/60' }}" 
                         alt="{{ $teacher->name }}" class="teacher-photo">
                    <div class="teacher-name">{{ $teacher->name }}</div>
                    <div class="teacher-specialty">{{ $teacher->specialty }}</div>
                </div>
                @endforeach
            </div>
            <input type="hidden" name="teacher_id" id="teacher_id" value="{{ $teacher->id ?? '' }}">
        </div>
        
        <!-- 날짜 선택 -->
        <div class="form-section">
            <h3 class="section-title">예약 날짜</h3>
            <input type="date" name="booking_date" id="booking_date" 
                   class="form-control" required 
                   min="{{ date('Y-m-d') }}"
                   max="{{ date('Y-m-d', strtotime('+2 months')) }}">
        </div>
        
        <!-- 시간 선택 -->
        <div class="form-section">
            <h3 class="section-title">예약 시간</h3>
            <div id="time-slots-container" class="time-slots">
                <p style="color: #706F6C; text-align: center; width: 100%;">
                    날짜를 선택하면 예약 가능한 시간이 표시됩니다.
                </p>
            </div>
            <input type="hidden" name="booking_time" id="booking_time" required>
            <div class="loading-spinner" id="loading-spinner">
                <i class="fas fa-spinner fa-spin" style="font-size: 24px; color: #FF6B35;"></i>
                <p style="margin-top: 10px; color: #706F6C;">시간대를 불러오는 중...</p>
            </div>
        </div>
        
        <!-- 예약자 정보 -->
        <div class="form-section">
            <h3 class="section-title">예약자 정보</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>학부모님 성함 <span class="required">*</span></label>
                    <input type="text" name="parent_name" class="form-control" 
                           value="{{ auth()->user()->name ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>연락처 <span class="required">*</span></label>
                    <input type="tel" name="parent_phone" class="form-control" 
                           placeholder="010-0000-0000" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>이메일 <span class="required">*</span></label>
                    <input type="email" name="parent_email" class="form-control" 
                           value="{{ auth()->user()->email ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>자녀 연령 <span class="required">*</span></label>
                    <select name="child_age" class="form-control" required>
                        <option value="">선택해주세요</option>
                        @for($i = 1; $i <= 13; $i++)
                        <option value="{{ $i }}">{{ $i }}세</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>특이사항</label>
                <textarea name="special_notes" class="form-control" rows="3" 
                          placeholder="알레르기, 특이사항 등을 입력해주세요."></textarea>
            </div>
        </div>
        
        <!-- 가격 정보 -->
        <div class="price-summary">
            <div class="price-row">
                <span>{{ $program->name }}</span>
                <span>{{ number_format($program->price) }}원</span>
            </div>
            <div class="price-row">
                <span>수업 시간</span>
                <span>{{ $program->duration }}분</span>
            </div>
            <div class="price-total">
                <span>결제 예정 금액</span>
                <span>{{ number_format($program->price) }}원</span>
            </div>
        </div>
        
        <!-- 액션 버튼 -->
        <div class="booking-actions">
            <a href="{{ route('programs.show', $program->id) }}" class="btn-cancel">취소</a>
            <button type="submit" class="btn-submit" id="submit-btn">
                결제하기
            </button>
        </div>
    </form>
</div>

<script>
// 선생님 선택
document.querySelectorAll('.teacher-option').forEach(option => {
    option.addEventListener('click', function() {
        document.querySelectorAll('.teacher-option').forEach(opt => {
            opt.classList.remove('selected');
        });
        this.classList.add('selected');
        document.getElementById('teacher_id').value = this.dataset.teacherId;
        
        // 날짜가 선택되어 있으면 시간대 다시 불러오기
        const bookingDate = document.getElementById('booking_date').value;
        if (bookingDate) {
            loadAvailableSlots();
        }
    });
});

// 날짜 선택 시 시간대 불러오기
document.getElementById('booking_date').addEventListener('change', function() {
    loadAvailableSlots();
});

// 시간대 불러오기
function loadAvailableSlots() {
    const teacherId = document.getElementById('teacher_id').value;
    const bookingDate = document.getElementById('booking_date').value;
    
    if (!bookingDate) return;
    
    const container = document.getElementById('time-slots-container');
    const spinner = document.getElementById('loading-spinner');
    
    container.innerHTML = '';
    spinner.classList.add('active');
    
    fetch('{{ route("bookings.available-slots") }}?' + new URLSearchParams({
        teacher_id: teacherId || '',
        date: bookingDate
    }))
    .then(response => response.json())
    .then(data => {
        spinner.classList.remove('active');
        
        if (data.slots && data.slots.length > 0) {
            data.slots.forEach(slot => {
                const div = document.createElement('div');
                div.className = 'time-slot';
                div.textContent = slot.display;
                div.dataset.time = slot.time;
                
                div.addEventListener('click', function() {
                    document.querySelectorAll('.time-slot').forEach(s => {
                        s.classList.remove('selected');
                    });
                    this.classList.add('selected');
                    document.getElementById('booking_time').value = this.dataset.time;
                });
                
                container.appendChild(div);
            });
        } else {
            container.innerHTML = '<p style="color: #706F6C; text-align: center; width: 100%;">예약 가능한 시간이 없습니다.</p>';
        }
    })
    .catch(error => {
        spinner.classList.remove('active');
        container.innerHTML = '<p style="color: #FF6B35; text-align: center; width: 100%;">시간대를 불러오는 중 오류가 발생했습니다.</p>';
    });
}

// 폼 제출 전 검증
document.querySelector('.booking-form').addEventListener('submit', function(e) {
    const bookingTime = document.getElementById('booking_time').value;
    if (!bookingTime) {
        e.preventDefault();
        alert('예약 시간을 선택해주세요.');
        return false;
    }
});
</script>
@endsection
