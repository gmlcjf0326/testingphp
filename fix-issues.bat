@echo off
echo =====================================
echo 프로젝트 문제 해결 스크립트
echo =====================================

echo.
echo 1. 데이터베이스 설정 확인 중...
php artisan config:clear
php artisan cache:clear

echo.
echo 2. 데이터베이스 마이그레이션 실행...
php artisan migrate --force

echo.
echo 3. 시더 실행 (테스트 데이터 생성)...
php artisan db:seed --force

echo.
echo 4. 스토리지 링크 생성...
php artisan storage:link

echo.
echo 5. 권한 설정...
icacls storage /grant Everyone:F /T
icacls bootstrap\cache /grant Everyone:F /T

echo.
echo =====================================
echo 완료! 브라우저에서 확인해보세요.
echo =====================================
pause
