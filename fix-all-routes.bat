@echo off
echo =====================================
echo 라우트 이름 일괄 수정 스크립트
echo =====================================

echo.
echo 모든 view 파일에서 잘못된 라우트 이름을 수정합니다...

cd resources\views

REM PowerShell을 사용하여 일괄 변경
powershell -Command "Get-ChildItem -Recurse -Filter *.blade.php | ForEach-Object { (Get-Content $_.FullName) -replace 'route\(''products\.index''\)', 'route(''shop.products.index'')' -replace 'route\(''products\.show''', 'route(''shop.products.show''' -replace 'route\(''cart\.index''\)', 'route(''shop.cart.index'')' -replace 'route\(''cart\.add''', 'route(''shop.cart.add''' -replace 'route\(''cart\.remove''', 'route(''shop.cart.remove''' -replace 'route\(''cart\.clear''\)', 'route(''shop.cart.clear'')' -replace 'route\(''checkout\.', 'route(''shop.checkout.' -replace 'route\(''orders\.index''\)', 'route(''shop.orders.index'')' -replace 'route\(''orders\.show''', 'route(''shop.orders.show''' | Set-Content $_.FullName }"

cd ..\..

echo.
echo 캐시 클리어 중...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo.
echo =====================================
echo 완료! 모든 라우트 이름이 수정되었습니다.
echo =====================================
pause
