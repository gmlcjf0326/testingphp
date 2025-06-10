# 🛍️ 관리자 상품 관리 시스템 사용 가이드

## 🚀 시작하기

### 1. 데이터베이스 마이그레이션
```bash
cd C:\xampp\htdocs\mysite\newphp\shop-project
php artisan migrate
```

### 2. 관리자 계정 생성

#### 옵션 A: 시더를 사용한 자동 생성
```bash
php artisan db:seed --class=AdminUserSeeder
```
- 생성되는 관리자 계정:
  - 이메일: `admin@shop.com`
  - 비밀번호: `password`

#### 옵션 B: 기존 사용자를 관리자로 변경
```bash
php artisan tinker
```
```php
// 이메일로 사용자 찾기
$user = User::where('email', 'your-email@example.com')->first();
$user->is_admin = true;
$user->save();

// 또는 ID로 찾기
$user = User::find(1);
$user->is_admin = true;
$user->save();
```

### 3. 서버 시작
```bash
php artisan serve
```

## 📋 관리자 기능 사용법

### 1. 관리자 페이지 접속
1. http://127.0.0.1:8000 접속
2. 관리자 계정으로 로그인
3. 상단 사용자 메뉴에서 "관리자" 클릭

### 2. 대시보드
- **URL**: `/admin`
- **기능**:
  - 전체 상품, 주문, 회원 통계
  - 재고 부족 상품 알림
  - 최근 주문 목록

### 3. 상품 관리
- **URL**: `/admin/products`

#### 상품 등록
1. "새 상품 등록" 버튼 클릭
2. 필수 정보 입력:
   - 상품명
   - 상품 설명
   - 가격
   - 재고 수량
3. 선택사항:
   - 상품 이미지 업로드 (JPG, PNG, 최대 2MB)
   - 이미지 미업로드 시 기본 이미지 사용
4. "상품 등록" 클릭

#### 상품 수정
1. 상품 목록에서 "수정" 클릭
2. 정보 변경
3. 새 이미지 업로드 시 기존 이미지 교체
4. "수정 완료" 클릭

#### 상품 삭제
1. 상품 목록에서 "삭제" 클릭
2. 확인 메시지에서 "확인" 클릭
3. 상품 및 이미지 파일 삭제됨

## 🎨 UI 특징

### 사이드바
- 햄버거 메뉴로 접기/펼치기 가능
- 현재 페이지 하이라이트
- 빠른 네비게이션

### 재고 상태 표시
- 🟢 **녹색**: 재고 충분 (11개 이상)
- 🟡 **노란색**: 재고 부족 경고 (1-10개)
- 🔴 **빨간색**: 품절 (0개)

### 이미지 처리
- 업로드 전 미리보기
- 자동 리사이징
- `public/storage/products` 폴더에 저장

## 🔒 보안

### 접근 제한
- 관리자만 접근 가능 (`is_admin = true`)
- 미들웨어로 보호
- 비인가 접근 시 403 에러

### 데이터 보호
- CSRF 토큰 검증
- 입력값 검증
- SQL 인젝션 방지

## 🛠️ 문제 해결

### "관리자만 접근할 수 있습니다" 오류
```bash
php artisan tinker
>>> $user = User::find(your_user_id);
>>> $user->is_admin = true;
>>> $user->save();
```

### 이미지 업로드 실패
1. storage 링크 확인:
```bash
php artisan storage:link
```

2. 폴더 권한 확인:
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 마이그레이션 오류
```bash
# 캐시 삭제
php artisan cache:clear
php artisan config:clear

# 다시 시도
php artisan migrate
```

## 📱 반응형 디자인
- 데스크톱: 풀 사이드바
- 태블릿: 축소 가능한 사이드바
- 모바일: 햄버거 메뉴

## 🎯 다음 단계 추천 기능

1. **상품 카테고리**
   - 카테고리별 분류
   - 카테고리 관리

2. **대량 작업**
   - CSV 일괄 업로드
   - 선택 삭제

3. **고급 검색**
   - 가격대별 필터
   - 재고 상태별 필터
   - 상품명 검색

4. **판매 분석**
   - 베스트셀러
   - 매출 통계
   - 재고 회전율

---

**작성일**: 2025-06-10  
**버전**: 1.0
