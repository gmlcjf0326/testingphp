@echo off
echo ========================================
echo 뮤지토리 프로젝트 종합 에러 수정
echo ========================================
echo.

cd C:\xampp\htdocs\mysite\newphp\shop-project

echo 1. 캐시 완전 초기화...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo.

echo 2. 데이터베이스 재설정...
echo Y | php artisan migrate:fresh
echo.

echo 3. 시더 데이터 실행...
php artisan db:seed --class=DatabaseSeeder
echo.

echo 4. 스토리지 링크 재생성...
php artisan storage:link
echo.

echo 5. 컴포저 오토로드 재생성...
composer dump-autoload
echo.

echo 6. 설정 캐시 재생성...
php artisan config:cache
echo.

echo 7. 라우트 캐시 재생성...
php artisan route:cache
echo.

echo ========================================
echo 수정 완료!
echo.
echo 서버 실행 명령어:
echo php artisan serve
echo.
echo 테스트 URL:
echo - 메인: http://127.0.0.1:8000/
echo - 프로그램: http://127.0.0.1:8000/programs
echo - 교재구매(쇼핑몰): http://127.0.0.1:8000/shop
echo - 로그인: http://127.0.0.1:8000/login
echo - 회원가입: http://127.0.0.1:8000/register
echo - 관리자: http://127.0.0.1:8000/admin
echo.
echo 관리자 계정:
echo - 이메일: admin@shop.com
echo - 비밀번호: password
echo ========================================
pause
