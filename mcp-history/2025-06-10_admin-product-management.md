# 관리자 상품 관리 기능 구현

## 작업 일시: 2025-06-10

## 목표
관리자가 상품을 CRUD(Create, Read, Update, Delete)할 수 있는 관리 시스템 구현

## 구현 내용

### 1. 관리자 권한 시스템
- `is_admin` 컬럼을 users 테이블에 추가
- `isAdmin()` 메서드를 User 모델에 추가
- AdminMiddleware 생성 및 등록

### 2. 관리자 대시보드
- 통계 정보 표시
  - 전체 상품 수
  - 전체 주문 수
  - 가입 회원 수
  - 재고 부족 상품
- 최근 주문 목록
- 재고 부족 상품 알림

### 3. 상품 관리 기능
- **목록 보기**: 페이지네이션 지원
- **상품 등록**: 이미지 업로드 포함
- **상품 수정**: 기존 데이터 수정
- **상품 삭제**: 확인 후 삭제
- **상품 상세**: 상세 정보 확인

### 4. UI/UX 특징
- 사이드바 네비게이션 (접기/펼치기 가능)
- ANUTA 스타일과 일관된 디자인
- 반응형 레이아웃
- 이미지 미리보기 기능
- 재고 상태별 색상 표시

## 생성된 파일

### 마이그레이션
- `database/migrations/2025_06_10_add_is_admin_to_users_table.php`

### 미들웨어
- `app/Http/Middleware/AdminMiddleware.php`

### 컨트롤러
- `app/Http/Controllers/Admin/DashboardController.php`
- `app/Http/Controllers/Admin/ProductController.php`

### 뷰 파일
- `resources/views/layouts/admin.blade.php` - 관리자 레이아웃
- `resources/views/admin/dashboard.blade.php` - 대시보드
- `resources/views/admin/products/index.blade.php` - 상품 목록
- `resources/views/admin/products/create.blade.php` - 상품 등록
- `resources/views/admin/products/edit.blade.php` - 상품 수정
- `resources/views/admin/products/show.blade.php` - 상품 상세

### 시더
- `database/seeders/AdminUserSeeder.php` - 관리자 계정 생성

## 수정된 파일
- `app/Models/User.php` - isAdmin() 메서드 추가
- `bootstrap/app.php` - 관리자 미들웨어 등록
- `routes/web.php` - 관리자 라우트 추가
- `resources/views/layouts/shop.blade.php` - 관리자 링크 추가

## 실행 방법

### 1. 마이그레이션 실행
```bash
php artisan migrate
```

### 2. 관리자 계정 생성
```bash
# 방법 1: 시더 실행
php artisan db:seed --class=AdminUserSeeder

# 방법 2: 직접 생성
php artisan tinker
>>> $user = User::find(1); // 또는 특정 사용자
>>> $user->is_admin = true;
>>> $user->save();
```

### 3. 서버 시작
```bash
php artisan serve
```

### 4. 관리자 접속
1. 일반 사용자로 로그인
2. 상단 드롭다운 메뉴에서 "관리자" 클릭
3. 관리자 대시보드 접속

## 기본 관리자 계정
- 이메일: `admin@shop.com`
- 비밀번호: `password`

## 주요 기능

### 상품 이미지 처리
- 로컬 업로드 지원
- 이미지 미리보기
- 기본 이미지 제공 (Unsplash)
- 이미지 삭제 시 파일도 함께 삭제

### 재고 관리
- 재고 수량별 색상 표시
  - 10개 초과: 녹색
  - 1-10개: 노란색
  - 0개: 빨간색
- 대시보드에서 재고 부족 상품 한눈에 확인

### 보안
- 관리자 미들웨어로 접근 제한
- CSRF 토큰 보호
- 삭제 시 확인 절차

## 추가 개발 가능한 기능
1. 상품 카테고리 관리
2. 대량 상품 등록 (CSV 업로드)
3. 상품 검색 및 필터링
4. 판매 통계 및 리포트
5. 주문 관리 시스템
6. 고객 관리
7. 쿠폰/할인 관리
8. 배송 관리
