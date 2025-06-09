@extends('layouts.shop')

@section('title', '프로필 설정 - ANUTA SHOP')

@section('content')
<div class="anuta-container">
    <h1 class="page-title">Profile Settings</h1>
    
    <div style="max-width: 800px; margin: 0 auto;">
        <!-- 프로필 정보 수정 -->
        <div style="background: white; border-radius: 8px; padding: 40px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); margin-bottom: 30px;">
            <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 30px; color: var(--anuta-text);">
                <i class="fas fa-user" style="color: var(--anuta-primary); margin-right: 10px;"></i>
                프로필 정보
            </h2>
            
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
                
                <div style="margin-bottom: 25px;">
                    <label for="name" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                        이름
                    </label>
                    <input id="name" 
                           name="name" 
                           type="text" 
                           value="{{ old('name', $user->name) }}" 
                           required 
                           autofocus 
                           autocomplete="name"
                           style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                           class="@error('name') error @enderror">
                    @error('name')
                        <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div style="margin-bottom: 25px;">
                    <label for="email" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                        이메일
                    </label>
                    <input id="email" 
                           name="email" 
                           type="email" 
                           value="{{ old('email', $user->email) }}" 
                           required 
                           autocomplete="username"
                           style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                           class="@error('email') error @enderror">
                    @error('email')
                        <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                    
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div style="margin-top: 10px;">
                            <p style="font-size: 14px; color: var(--anuta-text-light);">
                                이메일 주소가 인증되지 않았습니다.
                                
                                <button form="send-verification" class="anuta-btn-outline" style="padding: 5px 15px; font-size: 14px; margin-left: 10px;">
                                    인증 이메일 재전송
                                </button>
                            </p>
                            
                            @if (session('status') === 'verification-link-sent')
                                <p style="margin-top: 10px; font-size: 14px; color: #66BB6A;">
                                    새로운 인증 링크가 이메일로 전송되었습니다.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
                
                <div style="display: flex; align-items: center; gap: 15px;">
                    <button type="submit" class="anuta-btn">
                        저장
                    </button>
                    
                    @if (session('status') === 'profile-updated')
                        <p style="font-size: 14px; color: #66BB6A; margin: 0;">
                            저장되었습니다.
                        </p>
                    @endif
                </div>
            </form>
            
            <form id="send-verification" method="post" action="{{ route('verification.send') }}" style="display: none;">
                @csrf
            </form>
        </div>
        
        <!-- 비밀번호 변경 -->
        <div style="background: white; border-radius: 8px; padding: 40px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); margin-bottom: 30px;">
            <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 30px; color: var(--anuta-text);">
                <i class="fas fa-lock" style="color: var(--anuta-primary); margin-right: 10px;"></i>
                비밀번호 변경
            </h2>
            
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                
                <div style="margin-bottom: 25px;">
                    <label for="current_password" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                        현재 비밀번호
                    </label>
                    <input id="current_password" 
                           name="current_password" 
                           type="password" 
                           autocomplete="current-password"
                           style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                           class="@error('current_password') error @enderror">
                    @error('current_password')
                        <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div style="margin-bottom: 25px;">
                    <label for="password" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                        새 비밀번호
                    </label>
                    <input id="password" 
                           name="password" 
                           type="password" 
                           autocomplete="new-password"
                           style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                           class="@error('password') error @enderror">
                    @error('password')
                        <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div style="margin-bottom: 25px;">
                    <label for="password_confirmation" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                        새 비밀번호 확인
                    </label>
                    <input id="password_confirmation" 
                           name="password_confirmation" 
                           type="password" 
                           autocomplete="new-password"
                           style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                           class="@error('password_confirmation') error @enderror">
                    @error('password_confirmation')
                        <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div style="display: flex; align-items: center; gap: 15px;">
                    <button type="submit" class="anuta-btn">
                        비밀번호 변경
                    </button>
                    
                    @if (session('status') === 'password-updated')
                        <p style="font-size: 14px; color: #66BB6A; margin: 0;">
                            비밀번호가 변경되었습니다.
                        </p>
                    @endif
                </div>
            </form>
        </div>
        
        <!-- 계정 삭제 -->
        <div style="background: white; border-radius: 8px; padding: 40px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
            <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 20px; color: var(--anuta-text);">
                <i class="fas fa-exclamation-triangle" style="color: #E57373; margin-right: 10px;"></i>
                계정 삭제
            </h2>
            
            <p style="color: var(--anuta-text-light); margin-bottom: 20px; line-height: 1.6;">
                계정을 삭제하면 모든 리소스와 데이터가 영구적으로 삭제됩니다. 
                계정을 삭제하기 전에 보관하려는 데이터나 정보를 다운로드하세요.
            </p>
            
            <button type="button" 
                    onclick="document.getElementById('deleteModal').style.display='block'"
                    style="background: #E57373; color: white; padding: 10px 20px; border: none; border-radius: 4px; font-weight: 500; cursor: pointer; transition: background 0.3s;">
                <i class="fas fa-trash"></i> 계정 삭제
            </button>
        </div>
    </div>
</div>

<!-- 계정 삭제 모달 -->
<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 9999;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; border-radius: 8px; padding: 40px; max-width: 500px; width: 90%; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);">
        <h3 style="font-size: 24px; font-weight: 600; margin-bottom: 20px; color: var(--anuta-text);">
            정말로 계정을 삭제하시겠습니까?
        </h3>
        
        <p style="color: var(--anuta-text-light); margin-bottom: 20px;">
            계정 삭제를 확인하려면 비밀번호를 입력하세요.
        </p>
        
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            
            <div style="margin-bottom: 20px;">
                <label for="password_delete" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                    비밀번호
                </label>
                <input id="password_delete" 
                       name="password" 
                       type="password" 
                       placeholder="비밀번호를 입력하세요"
                       style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px;">
            </div>
            
            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <button type="button" 
                        onclick="document.getElementById('deleteModal').style.display='none'"
                        class="anuta-btn-outline">
                    취소
                </button>
                
                <button type="submit" 
                        style="background: #E57373; color: white; padding: 10px 20px; border: none; border-radius: 4px; font-weight: 500; cursor: pointer;">
                    계정 삭제
                </button>
            </div>
        </form>
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
    
    /* 삭제 버튼 호버 */
    button[style*="background: #E57373"]:hover {
        background: #C62828 !important;
    }
    
    /* 반응형 디자인 */
    @media (max-width: 768px) {
        .anuta-container > div > div {
            padding: 30px 20px !important;
        }
    }
</style>

<script>
// 모달 외부 클릭시 닫기
window.onclick = function(event) {
    const modal = document.getElementById('deleteModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
@endsection
