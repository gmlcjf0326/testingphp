@echo off
echo =====================================
echo 라우트 이름 일괄 수정
echo =====================================

echo.
php fix-routes.php

echo.
echo 캐시 정리 중...
php artisan config:clear
php artisan cache:clear  
php artisan route:clear
php artisan view:clear

echo.
echo =====================================
echo 완료! 브라우저에서 다시 확인해보세요.
echo =====================================
pause
