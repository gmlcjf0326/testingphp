@echo off
echo =====================================
echo Shop 라우트 에러 수정 스크립트
echo =====================================

echo.
echo 1. 캐시 정리 중...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo.
echo 2. 라우트 리스트 확인...
php artisan route:list | findstr "shop"

echo.
echo =====================================
echo 완료! 다시 접속해보세요.
echo =====================================
pause
