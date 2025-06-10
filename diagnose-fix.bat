@echo off
echo ========================================
echo 뮤지토리 프로젝트 에러 진단 및 수정
echo ========================================
echo.

cd C:\xampp\htdocs\mysite\newphp\shop-project

echo 1. PHP 설정 확인...
php -v
echo.

echo 2. 데이터베이스 연결 테스트...
php artisan db:show
echo.

echo 3. 마이그레이션 상태 확인...
php artisan migrate:status
echo.

echo 4. 데이터베이스 재설정 및 시드 실행...
echo 주의: 모든 데이터가 초기화됩니다!
pause

php artisan migrate:fresh --seed
echo.

echo 5. 라우트 캐시 재생성...
php artisan route:clear
php artisan route:cache
echo.

echo 6. 뷰 캐시 정리...
php artisan view:clear
echo.

echo 7. 설정 캐시 재생성...
php artisan config:clear
php artisan config:cache
echo.

echo 8. 스토리지 링크 재생성...
php artisan storage:link
echo.

echo 9. 컴포저 오토로드 재생성...
composer dump-autoload
echo.

echo 10. 라우트 목록 확인 (주요 라우트)...
php artisan route:list --columns=method,uri,name --name=login
php artisan route:list --columns=method,uri,name --name=register  
php artisan route:list --columns=method,uri,name --name=shop
echo.

echo ========================================
echo 진단 및 수정 완료!
echo.
echo 서버를 시작하려면:
echo php artisan serve
echo.
echo 테스트 URL:
echo - 메인: http://127.0.0.1:8000/
echo - 로그인: http://127.0.0.1:8000/login
echo - 회원가입: http://127.0.0.1:8000/register
echo - 교재구매: http://127.0.0.1:8000/shop
echo ========================================
pause
