<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ANUTA Shop')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --anuta-bg: #FDF6F0;
            --anuta-primary: #FF6B35;
            --anuta-text: #1B1B18;
            --anuta-text-light: #706F6C;
            --anuta-border: #E3E3E0;
            --anuta-white: #FFFFFF;
            --anuta-hover: #FF5722;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Noto Sans KR', sans-serif;
            background-color: var(--anuta-bg);
            color: var(--anuta-text);
            line-height: 1.6;
        }
        
        /* 헤더 스타일 */
        .anuta-header {
            background-color: var(--anuta-bg);
            padding: 20px 0;
            border-bottom: 1px solid var(--anuta-border);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .anuta-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .anuta-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .anuta-logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--anuta-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .anuta-logo img {
            height: 40px;
        }
        
        .anuta-nav-menu {
            display: flex;
            align-items: center;
            gap: 30px;
            list-style: none;
        }
        
        .anuta-nav-link {
            color: var(--anuta-text);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .anuta-nav-link:hover {
            color: var(--anuta-primary);
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -12px;
            background: var(--anuta-primary);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
        }
        
        /* 메인 콘텐츠 */
        .anuta-main {
            min-height: calc(100vh - 200px);
            padding: 40px 0;
        }
        
        /* 제품 카드 스타일 */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .product-card {
            background: var(--anuta-white);
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            color: inherit;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .product-image {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }
        
        .product-info {
            padding: 20px;
        }
        
        .product-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--anuta-text);
        }
        
        .product-description {
            font-size: 14px;
            color: var(--anuta-text-light);
            margin-bottom: 12px;
            line-height: 1.5;
        }
        
        .product-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--anuta-primary);
        }
        
        /* 페이지 타이틀 */
        .page-title {
            font-size: 48px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
            color: var(--anuta-text);
        }
        
        /* 버튼 스타일 */
        .anuta-btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--anuta-primary);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            transition: background-color 0.3s;
            cursor: pointer;
            font-size: 16px;
        }
        
        .anuta-btn:hover {
            background-color: var(--anuta-hover);
        }
        
        .anuta-btn-outline {
            background-color: transparent;
            border: 2px solid var(--anuta-primary);
            color: var(--anuta-primary);
        }
        
        .anuta-btn-outline:hover {
            background-color: var(--anuta-primary);
            color: white;
        }
        
        /* 알림 메시지 */
        .anuta-alert {
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 4px;
            position: relative;
        }
        
        .anuta-alert-success {
            background-color: #D4EDDA;
            color: #155724;
            border: 1px solid #C3E6CB;
        }
        
        .anuta-alert-error {
            background-color: #F8D7DA;
            color: #721C24;
            border: 1px solid #F5C6CB;
        }
        
        .alert-close {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: inherit;
        }
        
        /* 푸터 */
        .anuta-footer {
            background-color: var(--anuta-text);
            color: var(--anuta-white);
            padding: 60px 0 40px;
            margin-top: 80px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-section h3 {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section ul li {
            margin-bottom: 10px;
        }
        
        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-section a:hover {
            color: var(--anuta-primary);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }
        
        /* 모바일 메뉴 토글 */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--anuta-text);
        }
        
        /* 반응형 디자인 */
        @media (max-width: 768px) {
            .anuta-nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--anuta-bg);
                flex-direction: column;
                padding: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            
            .anuta-nav-menu.active {
                display: flex;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .page-title {
                font-size: 36px;
            }
            
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- 헤더 -->
    <header class="anuta-header">
        <div class="anuta-container">
            <nav class="anuta-nav">
                <a href="{{ route('shop.products.index') }}" class="anuta-logo">
                    ANUTA SHOP
                </a>
                
                <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars"></i>
                </button>
                
                <ul class="anuta-nav-menu" id="navMenu">
                    <li>
                        <a href="{{ route('home') }}" class="anuta-nav-link">
                            <i class="fas fa-arrow-left"></i> 뮤지토리 홈
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop.products.index') }}" class="anuta-nav-link">
                            쇼핑몰 홈
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop.cart.index') }}" class="anuta-nav-link" style="position: relative;">
                            <i class="fas fa-shopping-cart"></i> 장바구니
                            @php
                                $cartCount = 0;
                                if (Auth::check()) {
                                    $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                                } else {
                                    $cartCount = session()->has('cart') ? count(session('cart')) : 0;
                                }
                            @endphp
                            @if($cartCount > 0)
                                <span class="cart-badge">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>
                    
                    @auth
                        <li class="nav-dropdown">
                            <a href="#" class="anuta-nav-link" onclick="toggleDropdown(event)">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                                <i class="fas fa-chevron-down" style="font-size: 12px;"></i>
                            </a>
                            <ul class="dropdown-menu" id="userDropdown">
                                <li>
                                    <a href="{{ route('dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i> 대시보드
                                    </a>
                                </li>
                                @if(Auth::user()->isAdmin())
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-cogs"></i> 관리자
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-cog"></i> 프로필
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit">
                                            <i class="fas fa-sign-out-alt"></i> 로그아웃
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="anuta-nav-link">
                                로그인
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="anuta-btn">
                                회원가입
                            </a>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>
    
    <!-- 알림 메시지 -->
    <div class="anuta-container">
        @if(session('success'))
            <div class="anuta-alert anuta-alert-success">
                {{ session('success') }}
                <button class="alert-close" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="anuta-alert anuta-alert-error">
                {{ session('error') }}
                <button class="alert-close" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif
    </div>
    
    <!-- 메인 콘텐츠 -->
    <main class="anuta-main">
        @yield('content')
    </main>
    
    <!-- 푸터 -->
    <footer class="anuta-footer">
        <div class="anuta-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>ANUTA SHOP</h3>
                    <p style="color: rgba(255, 255, 255, 0.8); line-height: 1.8;">
                        아누타의 가치와 함께하실<br>
                        여러분의 연락을 기다립니다
                    </p>
                </div>
                
                <div class="footer-section">
                    <h3>빠른 링크</h3>
                    <ul>
                        <li><a href="{{ route('shop.products.index') }}">전체 상품</a></li>
                        <li><a href="{{ route('shop.cart.index') }}">장바구니</a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}">마이페이지</a></li>
                        @else
                            <li><a href="{{ route('login') }}">로그인</a></li>
                        @endauth
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>고객센터</h3>
                    <ul>
                        <li><a href="#">문의: 042-867-1589</a></li>
                        <li><a href="#">평일 09:00~18:00</a></li>
                        <li><a href="#">anuta@anutaworks.com</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>소셜 미디어</h3>
                    <ul>
                        <li><a href="#"><i class="fab fa-youtube"></i> 유튜브</a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i> 인스타그램</a></li>
                        <li><a href="#"><i class="fas fa-blog"></i> 블로그</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025. ANUTA SHOP. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script>
        // 모바일 메뉴 토글
        function toggleMobileMenu() {
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('active');
        }
        
        // 드롭다운 토글
        function toggleDropdown(event) {
            event.preventDefault();
            const dropdown = event.target.nextElementSibling;
            if (dropdown) {
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            }
        }
        
        // 클릭 외부 영역 클릭시 드롭다운 닫기
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown-menu');
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target) && !event.target.matches('.anuta-nav-link')) {
                    dropdown.style.display = 'none';
                }
            });
        });
    </script>
    
    <!-- 드롭다운 스타일 추가 -->
    <style>
        .nav-dropdown {
            position: relative;
        }
        
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid var(--anuta-border);
            border-radius: 4px;
            min-width: 200px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            margin-top: 10px;
        }
        
        .dropdown-menu li {
            list-style: none;
        }
        
        .dropdown-menu a,
        .dropdown-menu button {
            display: block;
            padding: 12px 20px;
            color: var(--anuta-text);
            text-decoration: none;
            transition: background-color 0.3s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 14px;
            font-family: inherit;
            cursor: pointer;
        }
        
        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background-color: var(--anuta-bg);
            color: var(--anuta-primary);
        }
        
        .dropdown-menu li:not(:last-child) {
            border-bottom: 1px solid var(--anuta-border);
        }
    </style>
    
    @stack('scripts')
</body>
</html>
