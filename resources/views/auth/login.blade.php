@extends('layouts.shop')

@section('title', '로그인 - ANUTA SHOP')

@section('content')
<div class="anuta-container">
    <div style="max-width: 480px; margin: 60px auto;">
        <!-- 로그인 헤더 -->
        <div style="text-align: center; margin-bottom: 40px;">
            <h1 style="font-size: 36px; font-weight: 700; margin-bottom: 10px; color: var(--anuta-text);">
                로그인
            </h1>
            <p style="color: var(--anuta-text-light);">
                ANUTA SHOP에 오신 것을 환영합니다
            </p>
        </div>

        <!-- 로그인 폼 -->
        <div style="background: white; border-radius: 8px; padding: 40px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
            <!-- Session Status -->
            @if (session('status'))
                <div style="background: #E8F5E9; border: 1px solid #C8E6C9; border-radius: 4px; padding: 15px; margin-bottom: 20px; color: #2E7D32;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div style="margin-bottom: 25px;">
                    <label for="email" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                        이메일
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username"
                           style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                           class="@error('email') error @enderror">
                    @error('email')
                        <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom: 25px;">
                    <label for="password" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                        비밀번호
                    </label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="current-password"
                           style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                           class="@error('password') error @enderror">
                    @error('password')
                        <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div style="margin-bottom: 30px;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input id="remember_me" 
                               type="checkbox" 
                               name="remember"
                               style="width: 18px; height: 18px; cursor: pointer;">
                        <span style="font-size: 14px; color: var(--anuta-text-light);">로그인 상태 유지</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="anuta-btn" style="width: 100%; padding: 15px; font-size: 18px; margin-bottom: 20px;">
                    로그인
                </button>

                <!-- Links -->
                <div style="text-align: center;">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" 
                           style="color: var(--anuta-text-light); text-decoration: none; font-size: 14px; transition: color 0.3s;">
                            비밀번호를 잊으셨나요?
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- 회원가입 안내 -->
        <div style="text-align: center; margin-top: 30px;">
            <p style="color: var(--anuta-text-light);">
                아직 회원이 아니신가요?
                <a href="{{ route('register') }}" 
                   style="color: var(--anuta-primary); text-decoration: none; font-weight: 500; transition: opacity 0.3s;">
                    회원가입
                </a>
            </p>
        </div>

        <!-- 소셜 로그인 (옵션) -->
        <div style="margin-top: 40px;">
            <div style="text-align: center; position: relative; margin-bottom: 30px;">
                <span style="background: var(--anuta-bg); padding: 0 20px; position: relative; z-index: 1; color: var(--anuta-text-light); font-size: 14px;">
                    또는
                </span>
                <div style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: var(--anuta-border);"></div>
            </div>
            
            <div style="display: flex; gap: 15px;">
                <button type="button" 
                        style="flex: 1; padding: 12px; border: 2px solid var(--anuta-border); background: white; border-radius: 4px; font-weight: 500; cursor: pointer; transition: all 0.3s;"
                        onclick="alert('구글 로그인은 준비중입니다.')">
                    <i class="fab fa-google" style="margin-right: 8px; color: #4285F4;"></i>
                    Google로 로그인
                </button>
                
                <button type="button" 
                        style="flex: 1; padding: 12px; border: 2px solid var(--anuta-border); background: white; border-radius: 4px; font-weight: 500; cursor: pointer; transition: all 0.3s;"
                        onclick="alert('카카오 로그인은 준비중입니다.')">
                    <i class="fas fa-comment" style="margin-right: 8px; color: #FEE500;"></i>
                    Kakao로 로그인
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 추가 스타일 -->
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
    
    /* 소셜 로그인 버튼 호버 */
    button[type="button"]:hover {
        border-color: var(--anuta-primary) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    /* 반응형 디자인 */
    @media (max-width: 480px) {
        .anuta-container > div {
            margin: 30px auto !important;
        }
        
        .anuta-container > div > div:nth-child(2) {
            padding: 30px 20px !important;
        }
        
        .anuta-container > div > div:last-child > div:last-child {
            flex-direction: column;
        }
    }
</style>
@endsection
