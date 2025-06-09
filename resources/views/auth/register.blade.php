@extends('layouts.shop')

@section('title', '회원가입 - ANUTA SHOP')

@section('content')
<div class="anuta-container">
    <div style="max-width: 480px; margin: 60px auto;">
        <!-- 회원가입 헤더 -->
        <div style="text-align: center; margin-bottom: 40px;">
            <h1 style="font-size: 36px; font-weight: 700; margin-bottom: 10px; color: var(--anuta-text);">
                회원가입
            </h1>
            <p style="color: var(--anuta-text-light);">
                ANUTA SHOP의 회원이 되어 특별한 혜택을 받아보세요
            </p>
        </div>

        <!-- 회원가입 폼 -->
        <div style="background: white; border-radius: 8px; padding: 40px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div style="margin-bottom: 25px;">
                    <label for="name" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                        이름 <span style="color: var(--anuta-primary);">*</span>
                    </label>
                    <input id="name" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name"
                           placeholder="홍길동"
                           style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                           class="@error('name') error @enderror">
                    @error('name')
                        <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div style="margin-bottom: 25px;">
                    <label for="email" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                        이메일 <span style="color: var(--anuta-primary);">*</span>
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="username"
                           placeholder="example@email.com"
                           style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                           class="@error('email') error @enderror">
                    @error('email')
                        <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom: 25px;">
                    <label for="password" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                        비밀번호 <span style="color: var(--anuta-primary);">*</span>
                    </label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="new-password"
                           placeholder="8자 이상 입력해주세요"
                           style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                           class="@error('password') error @enderror">
                    @error('password')
                        <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                    <p style="font-size: 13px; color: var(--anuta-text-light); margin-top: 5px;">
                        비밀번호는 최소 8자 이상이어야 합니다.
                    </p>
                </div>

                <!-- Confirm Password -->
                <div style="margin-bottom: 30px;">
                    <label for="password_confirmation" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                        비밀번호 확인 <span style="color: var(--anuta-primary);">*</span>
                    </label>
                    <input id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           placeholder="비밀번호를 다시 입력해주세요"
                           style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                           class="@error('password_confirmation') error @enderror">
                    @error('password_confirmation')
                        <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- 약관 동의 -->
                <div style="margin-bottom: 30px; padding: 20px; background: var(--anuta-bg); border-radius: 4px;">
                    <label style="display: flex; align-items: start; gap: 10px; cursor: pointer; margin-bottom: 15px;">
                        <input type="checkbox" 
                               name="agree_all" 
                               id="agree_all"
                               style="width: 18px; height: 18px; cursor: pointer; margin-top: 2px;">
                        <span style="font-weight: 500; color: var(--anuta-text);">전체 약관에 동의합니다</span>
                    </label>
                    
                    <div style="margin-left: 28px; font-size: 14px; color: var(--anuta-text-light);">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; margin-bottom: 8px;">
                            <input type="checkbox" 
                                   name="agree_terms" 
                                   required
                                   style="width: 16px; height: 16px; cursor: pointer;">
                            <span>[필수] 이용약관에 동의합니다</span>
                        </label>
                        
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; margin-bottom: 8px;">
                            <input type="checkbox" 
                                   name="agree_privacy" 
                                   required
                                   style="width: 16px; height: 16px; cursor: pointer;">
                            <span>[필수] 개인정보 처리방침에 동의합니다</span>
                        </label>
                        
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" 
                                   name="agree_marketing"
                                   style="width: 16px; height: 16px; cursor: pointer;">
                            <span>[선택] 마케팅 정보 수신에 동의합니다</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="anuta-btn" style="width: 100%; padding: 15px; font-size: 18px;">
                    회원가입
                </button>
            </form>
        </div>

        <!-- 로그인 안내 -->
        <div style="text-align: center; margin-top: 30px;">
            <p style="color: var(--anuta-text-light);">
                이미 회원이신가요?
                <a href="{{ route('login') }}" 
                   style="color: var(--anuta-primary); text-decoration: none; font-weight: 500; transition: opacity 0.3s;">
                    로그인
                </a>
            </p>
        </div>
    </div>
</div>

<!-- 추가 스타일 및 스크립트 -->
<style>
    /* 입력 필드 포커스 스타일 */
    input:focus {
        outline: none;
        border-color: var(--anuta-primary) !important;
    }
    
    input.error {
        border-color: #E57373 !important;
    }
    
    /* 체크박스 스타일 */
    input[type="checkbox"] {
        accent-color: var(--anuta-primary);
    }
    
    /* 링크 호버 효과 */
    a:hover {
        opacity: 0.8;
    }
    
    /* 반응형 디자인 */
    @media (max-width: 480px) {
        .anuta-container > div {
            margin: 30px auto !important;
        }
        
        .anuta-container > div > div:nth-child(2) {
            padding: 30px 20px !important;
        }
    }
</style>

<script>
// 전체 동의 체크박스 처리
document.getElementById('agree_all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('input[name^="agree_"]');
    checkboxes.forEach(checkbox => {
        if (checkbox.id !== 'agree_all') {
            checkbox.checked = this.checked;
        }
    });
});

// 개별 체크박스 상태에 따른 전체 동의 체크박스 업데이트
document.querySelectorAll('input[name^="agree_"]:not(#agree_all)').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const allChecked = Array.from(document.querySelectorAll('input[name^="agree_"]:not(#agree_all)')).every(cb => cb.checked);
        document.getElementById('agree_all').checked = allChecked;
    });
});
</script>
@endsection
