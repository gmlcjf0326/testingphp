<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '관리자 대시보드') - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * {
            font-family: 'Noto Sans KR', sans-serif;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'admin-primary': '#FF6B35',
                        'admin-bg': '#F8F9FA',
                        'admin-sidebar': '#2C3E50',
                        'admin-text': '#1B1B18',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-admin-bg">
    <div class="flex h-screen" x-data="{ sidebarOpen: true }">
        <!-- 사이드바 -->
        <aside class="bg-admin-sidebar text-white transition-all duration-300"
               :class="sidebarOpen ? 'w-64' : 'w-16'">
            <div class="p-4">
                <h1 class="text-2xl font-bold transition-all duration-300"
                    :class="sidebarOpen ? 'block' : 'hidden'">
                    관리자
                </h1>
                <button @click="sidebarOpen = !sidebarOpen" 
                        class="mt-4 p-2 hover:bg-gray-700 rounded transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 hover:bg-gray-700 transition-colors
                          {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="ml-3 transition-all duration-300"
                          :class="sidebarOpen ? 'block' : 'hidden'">대시보드</span>
                </a>
                
                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center px-4 py-3 hover:bg-gray-700 transition-colors
                          {{ request()->routeIs('admin.products.*') ? 'bg-gray-700' : '' }}">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span class="ml-3 transition-all duration-300"
                          :class="sidebarOpen ? 'block' : 'hidden'">상품 관리</span>
                </a>
                
                <a href="{{ route('products.index') }}" 
                   class="flex items-center px-4 py-3 hover:bg-gray-700 transition-colors mt-8">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="ml-3 transition-all duration-300"
                          :class="sidebarOpen ? 'block' : 'hidden'">쇼핑몰 보기</span>
                </a>
            </nav>
        </aside>

        <!-- 메인 콘텐츠 -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- 헤더 -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <h2 class="text-xl font-semibold text-admin-text">
                        @yield('header', '관리자 대시보드')
                    </h2>
                    
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">
                            {{ auth()->user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="text-sm text-red-600 hover:text-red-800 transition-colors">
                                로그아웃
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- 페이지 콘텐츠 -->
            <main class="flex-1 overflow-y-auto bg-admin-bg p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
