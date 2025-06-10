@echo off
echo 뮤지토리 프로젝트 설정 및 오류 수정 스크립트
echo =========================================

cd C:\xampp\htdocs\mysite\newphp\shop-project

echo.
echo 1. 데이터베이스 마이그레이션 실행...
php artisan migrate

echo.
echo 2. 시더 데이터 실행...
php artisan db:seed --class=ProgramSeeder
php artisan db:seed --class=TeacherSeeder  
php artisan db:seed --class=ReviewSeeder
php artisan db:seed --class=ProductSeeder
php artisan db:seed --class=AdminUserSeeder

echo.
echo 3. 스토리지 링크 생성...
php artisan storage:link

echo.
echo 4. 캐시 클리어...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo.
echo 5. 라우트 목록 확인...
php artisan route:list > routes.txt
echo 라우트 목록이 routes.txt 파일에 저장되었습니다.

echo.
echo 설정 완료!
echo.
echo 테스트 계정:
echo - 관리자: admin@shop.com / password
echo.
echo 주요 URL:
echo - 메인: http://127.0.0.1:8000/
echo - 프로그램: http://127.0.0.1:8000/programs
echo - 교재구매: http://127.0.0.1:8000/shop
echo - 로그인: http://127.0.0.1:8000/login
echo.
pause
