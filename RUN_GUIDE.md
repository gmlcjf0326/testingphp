# 뮤지토리 프로젝트 실행 가이드

## 1. 오류 수정 스크립트 실행

### Windows 사용자
```cmd
cd C:\xampp\htdocs\mysite\newphp\shop-project
fix-errors.bat
```

### Mac/Linux 사용자
```bash
cd /c/xampp/htdocs/mysite/newphp/shop-project
chmod +x fix-errors.sh
./fix-errors.sh
```

## 2. 서버 시작
```bash
php artisan serve
```

## 3. 확인해야 할 주요 기능

### 데스크톱에서 확인
1. **메인 홈페이지** (http://127.0.0.1:8000/)
   - 좌측 문의 폼이 고정되어 있는지 확인
   - 우측 콘텐츠가 스크롤되는지 확인

2. **네비게이션 메뉴**
   - 홈, 뮤지토리 소개, 프로그램, 선생님, 수업후기 클릭 시 정상 작동
   - 교재 구매 클릭 시 쇼핑몰로 이동 (http://127.0.0.1:8000/shop)
   - 로그인/회원가입 링크 작동 확인

3. **프로그램 페이지** (http://127.0.0.1:8000/programs)
   - 프로그램 목록이 카테고리별로 표시되는지 확인
   - 각 프로그램 클릭 시 상세 페이지 이동

4. **쇼핑몰** (http://127.0.0.1:8000/shop)
   - 상품 목록 표시 확인
   - 장바구니 기능 작동 확인

### 모바일에서 확인 (크롬 개발자 도구 > 모바일 뷰)
1. **반응형 레이아웃**
   - 좌측 패널이 숨겨지는지 확인
   - 햄버거 메뉴 버튼이 나타나는지 확인

2. **모바일 네비게이션**
   - 햄버거 메뉴 클릭 시 우측에서 슬라이드 메뉴 등장
   - 메뉴 항목 클릭 시 정상 이동

3. **문의 버튼**
   - 우측 하단에 플로팅 버튼 표시
   - 클릭 시 하단에서 문의 폼 슬라이드업
   - 스크롤 시 버튼 숨김/표시 애니메이션

## 4. 테스트 계정

### 일반 사용자
- 회원가입하여 새 계정 생성

### 관리자
- 이메일: admin@shop.com
- 비밀번호: password

## 5. 문제 해결

### 데이터베이스 에러가 발생하는 경우
```bash
php artisan migrate:fresh --seed
```

### 캐시 관련 문제
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 이미지가 표시되지 않는 경우
```bash
php artisan storage:link
```

## 6. 주요 URL 목록
- 메인: http://127.0.0.1:8000/
- 뮤지토리 소개: http://127.0.0.1:8000/about
- 프로그램: http://127.0.0.1:8000/programs
- 선생님: http://127.0.0.1:8000/teachers
- 수업후기: http://127.0.0.1:8000/reviews
- 쇼핑몰: http://127.0.0.1:8000/shop
- 로그인: http://127.0.0.1:8000/login
- 관리자: http://127.0.0.1:8000/admin
