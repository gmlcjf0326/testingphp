<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <title>{{ config('app.name', '뮤지토리') }} - 음악과 이야기가 만나는 곳</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }
        
        body {
            font-family: 'Noto Sans KR', sans-serif;
            background-color: #f8f9fa;
            color: #1B1B18;
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        /* 데스크톱 레이아웃 */
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* 좌측 패널 */
        .left-panel {
            width: 400px;
            background: white;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
            padding: 40px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            z-index: 10;
        }
        
        .logo {
            margin-bottom: 40px;
        }
        
        .logo h1 {
            font-size: 28px;
            color: #FF6B35;
            font-weight: 700;
        }
        
        .logo p {
            font-size: 14px;
            color: #706F6C;
            margin-top: 5px;
        }
        
        .inquiry-form {
            flex: 1;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            color: #1B1B18;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #E3E3E0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Noto Sans KR', sans-serif;
            transition: border-color 0.3s;
            -webkit-appearance: none;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #FF6B35;
        }
        
        .submit-btn {
            width: 100%;
            padding: 16px;
            background: #FF6B35;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 4px rgba(255, 107, 53, 0.2);
        }
        
        .submit-btn:hover {
            background: #ff5722;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(255, 107, 53, 0.3);
        }
        
        .submit-btn:active {
            transform: translateY(0);
        }
        
        .info-box {
            background: #FDF6F0;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }
        
        .info-box h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }
        
        .info-box p {
            font-size: 14px;
            color: #706F6C;
            line-height: 1.8;
        }
        
        /* 우측 메인 컨텐츠 */
        .main-content {
            margin-left: 400px;
            flex: 1;
            padding: 0;
            min-height: 100vh;
        }
        
        /* 네비게이션 */
        .nav {
            background: white;
            padding: 20px 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .nav-menu {
            display: flex;
            gap: 30px;
            list-style: none;
            align-items: center;
        }
        
        .nav-menu li {
            position: relative;
        }
        
        .nav-menu a {
            text-decoration: none;
            color: #1B1B18;
            font-weight: 500;
            transition: color 0.3s;
            display: inline-block;
            padding: 5px 0;
        }
        
        .nav-menu a:hover {
            color: #FF6B35;
        }
        
        .nav-menu a.active {
            color: #FF6B35;
            position: relative;
        }
        
        .nav-menu a.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            height: 2px;
            background: #FF6B35;
        }
        
        .nav-menu .shop-link {
            margin-left: auto;
        }
        
        .nav-menu .shop-link a {
            background: #FDF6F0;
            padding: 8px 20px;
            border-radius: 20px;
            color: #FF6B35;
        }
        
        .nav-menu .shop-link a:hover {
            background: #FF6B35;
            color: white;
        }
        
        /* 유저 메뉴 */
        .user-menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        
        .user-menu a {
            text-decoration: none;
            color: #706F6C;
            font-size: 14px;
        }
        
        .user-menu a:hover {
            color: #FF6B35;
        }
        
        /* 모바일 메뉴 버튼 */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #1B1B18;
            cursor: pointer;
            padding: 10px;
            margin-left: auto;
        }
        
        .mobile-nav-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .mobile-nav-overlay.active {
            display: block;
            opacity: 1;
        }
        
        .mobile-nav {
            position: fixed;
            top: 0;
            right: -280px;
            width: 280px;
            height: 100vh;
            background: white;
            box-shadow: -2px 0 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: right 0.3s ease;
            overflow-y: auto;
        }
        
        .mobile-nav.active {
            right: 0;
        }
        
        .mobile-nav-header {
            padding: 20px;
            border-bottom: 1px solid #E3E3E0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .mobile-nav-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }
        
        .mobile-nav-menu {
            list-style: none;
            padding: 20px;
        }
        
        .mobile-nav-menu li {
            margin-bottom: 20px;
        }
        
        .mobile-nav-menu a {
            text-decoration: none;
            color: #1B1B18;
            font-size: 16px;
            font-weight: 500;
            display: block;
            padding: 10px 0;
        }
        
        .mobile-nav-menu .shop-link a {
            background: #FDF6F0;
            padding: 12px 20px;
            border-radius: 8px;
            color: #FF6B35;
            text-align: center;
        }
        
        /* 모바일 하단 문의 버튼 */
        .mobile-inquiry-btn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #FF6B35;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: none;
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
            font-size: 24px;
            cursor: pointer;
            z-index: 100;
            transition: all 0.3s;
        }
        
        .mobile-inquiry-btn:hover {
            transform: scale(1.1);
        }
        
        /* 모바일 문의 폼 */
        .mobile-inquiry-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .mobile-inquiry-modal.active {
            display: block;
            opacity: 1;
        }
        
        .mobile-inquiry-content {
            position: fixed;
            bottom: -100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 20px 20px 0 0;
            padding: 20px;
            max-height: 90vh;
            overflow-y: auto;
            transition: bottom 0.3s ease;
        }
        
        .mobile-inquiry-modal.active .mobile-inquiry-content {
            bottom: 0;
        }
        
        .mobile-inquiry-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #E3E3E0;
        }
        
        /* 모바일 반응형 */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .left-panel {
                display: none;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .nav {
                padding: 15px 20px;
                position: fixed;
                width: 100%;
                top: 0;
            }
            
            .nav-menu {
                display: none;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .mobile-inquiry-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            /* 상단 여백 추가 (고정 헤더 때문에) */
            .content-wrapper {
                padding-top: 70px;
            }
        }
        
        /* 태블릿 반응형 */
        @media (min-width: 769px) and (max-width: 1024px) {
            .left-panel {
                width: 350px;
                padding: 30px;
            }
            
            .main-content {
                margin-left: 350px;
            }
            
            .nav {
                padding: 15px 30px;
            }
            
            .nav-menu {
                gap: 20px;
            }
        }
        
        /* 알림 메시지 */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container">
        <!-- 좌측 패널 (데스크톱) -->
        <aside class="left-panel">
            <div class="logo">
                <h1>뮤지토리</h1>
                <p>음악과 이야기가 만나는 특별한 교육</p>
            </div>
            
            <div class="inquiry-form">
                <h2 style="font-size: 20px; margin-bottom: 20px;">수업 문의하기</h2>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('inquiry.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">학부모님 성함</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">연락처</label>
                        <input type="tel" id="phone" name="phone" required placeholder="010-0000-0000">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">이메일</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="child_age">자녀 연령</label>
                        <select id="child_age" name="child_age" required>
                            <option value="">선택해주세요</option>
                            @for ($i = 1; $i <= 13; $i++)
                                <option value="{{ $i }}">{{ $i }}세</option>
                            @endfor
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="program_id">관심 프로그램</label>
                        <select id="program_id" name="program_id">
                            <option value="">선택해주세요</option>
                            @php
                                $programs = \App\Models\Program::active()->orderBy('name')->get();
                            @endphp
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">문의사항</label>
                        <textarea id="message" name="message" rows="4" placeholder="궁금하신 점을 자유롭게 작성해주세요."></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">문의하기</button>
                </form>
                
                <div class="info-box">
                    <h3>📞 전화 문의</h3>
                    <p>
                        010-7327-3379<br>
                        평일 09:00 ~ 17:00<br>
                        (점심시간 12:00 ~ 13:00)
                    </p>
                </div>
            </div>
        </aside>
        
        <!-- 우측 메인 컨텐츠 -->
        <main class="main-content">
            <nav class="nav">
                <ul class="nav-menu">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">홈</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">뮤지토리 소개</a></li>
                    <li><a href="{{ route('programs.index') }}" class="{{ request()->routeIs('programs.*') ? 'active' : '' }}">프로그램</a></li>
                    <li><a href="{{ route('teachers.index') }}" class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">선생님</a></li>
                    <li><a href="{{ route('reviews.index') }}" class="{{ request()->routeIs('reviews.*') ? 'active' : '' }}">수업후기</a></li>
                    <li class="shop-link"><a href="{{ route('shop.products.index') }}">교재 구매</a></li>
                    
                    <!-- 사용자 메뉴 -->
                    <li class="user-menu">
                        @auth
                            <a href="{{ route('dashboard') }}">마이페이지</a>
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}">관리자</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">로그아웃</a>
                            </form>
                        @else
                            <a href="{{ route('login') }}">로그인</a>
                            <a href="{{ route('register') }}">회원가입</a>
                        @endauth
                    </li>
                </ul>
                
                <!-- 모바일 메뉴 버튼 -->
                <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
            
            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>
    
    <!-- 모바일 네비게이션 -->
    <div class="mobile-nav-overlay" onclick="closeMobileMenu()"></div>
    <div class="mobile-nav">
        <div class="mobile-nav-header">
            <h2>메뉴</h2>
            <button class="mobile-nav-close" onclick="closeMobileMenu()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <ul class="mobile-nav-menu">
            <li><a href="{{ route('home') }}">홈</a></li>
            <li><a href="{{ route('about') }}">뮤지토리 소개</a></li>
            <li><a href="{{ route('programs.index') }}">프로그램</a></li>
            <li><a href="{{ route('teachers.index') }}">선생님</a></li>
            <li><a href="{{ route('reviews.index') }}">수업후기</a></li>
            <li class="shop-link"><a href="{{ route('shop.products.index') }}">교재 구매</a></li>
            <li style="border-top: 1px solid #E3E3E0; margin-top: 20px; padding-top: 20px;">
                @auth
                    <a href="{{ route('dashboard') }}">마이페이지</a>
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" style="margin-top: 10px;">관리자</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" style="margin-top: 10px;">로그아웃</a>
                    </form>
                @else
                    <a href="{{ route('login') }}">로그인</a>
                    <a href="{{ route('register') }}" style="margin-top: 10px;">회원가입</a>
                @endauth
            </li>
        </ul>
    </div>
    
    <!-- 모바일 문의 버튼 -->
    <button class="mobile-inquiry-btn" onclick="openInquiryModal()">
        <i class="fas fa-comment-dots"></i>
    </button>
    
    <!-- 모바일 문의 모달 -->
    <div class="mobile-inquiry-modal" onclick="closeInquiryModal(event)">
        <div class="mobile-inquiry-content" onclick="event.stopPropagation()">
            <div class="mobile-inquiry-header">
                <h2>수업 문의하기</h2>
                <button onclick="closeInquiryModal()" style="background: none; border: none; font-size: 24px; cursor: pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            @if(session('mobile-success'))
                <div class="alert alert-success">
                    {{ session('mobile-success') }}
                </div>
            @endif
            
            <form action="{{ route('inquiry.store') }}" method="POST">
                @csrf
                <input type="hidden" name="from_mobile" value="1">
                
                <div class="form-group">
                    <label for="mobile_name">학부모님 성함</label>
                    <input type="text" id="mobile_name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="mobile_phone">연락처</label>
                    <input type="tel" id="mobile_phone" name="phone" required placeholder="010-0000-0000">
                </div>
                
                <div class="form-group">
                    <label for="mobile_email">이메일</label>
                    <input type="email" id="mobile_email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="mobile_child_age">자녀 연령</label>
                    <select id="mobile_child_age" name="child_age" required>
                        <option value="">선택해주세요</option>
                        @for ($i = 1; $i <= 13; $i++)
                            <option value="{{ $i }}">{{ $i }}세</option>
                        @endfor
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="mobile_program_id">관심 프로그램</label>
                    <select id="mobile_program_id" name="program_id">
                        <option value="">선택해주세요</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="mobile_message">문의사항</label>
                    <textarea id="mobile_message" name="message" rows="4" placeholder="궁금하신 점을 자유롭게 작성해주세요."></textarea>
                </div>
                
                <button type="submit" class="submit-btn">문의하기</button>
                
                <div class="info-box" style="margin-top: 20px;">
                    <h3>📞 전화 문의</h3>
                    <p>
                        010-7327-3379<br>
                        평일 09:00 ~ 17:00<br>
                        (점심시간 12:00 ~ 13:00)
                    </p>
                </div>
            </form>
        </div>
    </div>
    
    @stack('scripts')
    
    <script>
        // 모바일 메뉴 토글
        function toggleMobileMenu() {
            const overlay = document.querySelector('.mobile-nav-overlay');
            const nav = document.querySelector('.mobile-nav');
            overlay.classList.toggle('active');
            nav.classList.toggle('active');
        }
        
        function closeMobileMenu() {
            const overlay = document.querySelector('.mobile-nav-overlay');
            const nav = document.querySelector('.mobile-nav');
            overlay.classList.remove('active');
            nav.classList.remove('active');
        }
        
        // 모바일 문의 모달
        function openInquiryModal() {
            const modal = document.querySelector('.mobile-inquiry-modal');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeInquiryModal(event) {
            if (!event || event.target.classList.contains('mobile-inquiry-modal')) {
                const modal = document.querySelector('.mobile-inquiry-modal');
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        }
        
        // 모바일에서 스크롤 시 문의 버튼 애니메이션
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            const btn = document.querySelector('.mobile-inquiry-btn');
            if (!btn) return;
            
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > lastScrollTop) {
                // 스크롤 다운
                btn.style.transform = 'translateY(100px)';
            } else {
                // 스크롤 업
                btn.style.transform = 'translateY(0)';
            }
            lastScrollTop = scrollTop;
        });
    </script>
</body>
</html>
