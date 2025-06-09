# Laravel 쇼핑몰 사용 가이드

## 🚀 프로젝트 실행 방법

### 1. XAMPP 실행
- XAMPP Control Panel 열기
- Apache: Start
- MySQL: Start

### 2. Laravel 개발 서버 실행
```cmd
cd C:\xampp\htdocs\mysite\newphp\shop-project
C:\xampp\php\php.exe artisan serve
```

### 3. 브라우저에서 접속
http://127.0.0.1:8000

## 📱 주요 기능

### 홈페이지
- 9개 상품이 3x3 그리드로 표시
- 각 상품 카드에 이미지, 이름, 가격, 재고 표시
- "상세보기" 버튼: 상품 상세 페이지로 이동
- "장바구니 담기" 버튼: 장바구니에 상품 추가

### 상품 상세 페이지
- 큰 상품 이미지
- 상품명, 가격, 재고 상태
- 상품 설명
- 장바구니 담기 버튼
- 무료배송, 30일 반품, 정품보증 아이콘

### 장바구니
- 담긴 상품 목록 테이블 형태로 표시
- 각 상품의 이미지, 이름, 가격, 수량, 소계
- 총 금액 자동 계산
- 개별 상품 삭제 가능
- 장바구니 전체 비우기 가능
- "쇼핑 계속하기" 버튼으로 홈페이지 이동

## 🎨 디자인 특징
- Bootstrap 5 기반 반응형 디자인
- 다크 테마 네비게이션 바
- 상품 카드 호버 효과
- Font Awesome 아이콘 사용
- 장바구니 아이템 수 뱃지 표시

## 🔧 개발자 정보

### 주요 파일 위치
- **컨트롤러**: `app/Http/Controllers/`
  - ProductController.php
  - CartController.php
- **모델**: `app/Models/Product.php`
- **뷰**: `resources/views/`
  - layouts/app.blade.php
  - products/index.blade.php
  - products/show.blade.php
  - cart/index.blade.php
- **라우트**: `routes/web.php`
- **마이그레이션**: `database/migrations/`
- **시더**: `database/seeders/ProductSeeder.php`

### 데이터베이스
- 데이터베이스명: laravel_shop
- 테이블: products
- 필드: id, name, price, image, description, stock

## 📝 추가 개발 예정
- 사용자 인증 (회원가입/로그인)
- 결제 기능
- 주문 관리
- 마이페이지
- 상품 검색
- 카테고리 분류
