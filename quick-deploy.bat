@echo off
REM quick-deploy.bat - Windows용 빠른 배포 준비 스크립트
chcp 65001 >nul
cls

echo 🚀 Laravel 쇼핑몰 배포 준비 스크립트
echo ==================================

REM 1. 환경 확인
echo.
echo 1. 환경 확인 중...
php -v | findstr /R "^PHP"
node -v
call npm -v

REM 2. .env 파일 확인
echo.
echo 2. 환경 설정 파일 확인...
if not exist .env (
    copy .env.example .env
    echo ✓ .env 파일 생성됨
    echo ⚠️  .env 파일을 수정해주세요!
) else (
    echo ✓ .env 파일 존재
)

REM 3. 의존성 설치
echo.
echo 3. 의존성 설치...
echo Composer 패키지 설치 중...
call composer install --optimize-autoloader --no-dev

echo.
echo NPM 패키지 설치 중...
call npm install

REM 4. 프론트엔드 빌드
echo.
echo 4. 프론트엔드 빌드...
call npm run build

REM 5. Laravel 최적화
echo.
echo 5. Laravel 최적화...

REM 키 생성 확인
findstr /C:"APP_KEY=base64:" .env >nul
if errorlevel 1 (
    php artisan key:generate
    echo ✓ 앱 키 생성됨
)

REM 캐시 생성
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo ✓ 캐시 생성 완료

REM 6. 배포 파일 생성
echo.
echo 6. 배포 파일 생성...
set TIMESTAMP=%date:~0,4%%date:~5,2%%date:~8,2%_%time:~0,2%%time:~3,2%%time:~6,2%
set TIMESTAMP=%TIMESTAMP: =0%
set DEPLOY_FILE=deploy_%TIMESTAMP%.tar.gz

tar -czf %DEPLOY_FILE% ^
    --exclude=node_modules ^
    --exclude=.git ^
    --exclude=.env ^
    --exclude=tests ^
    --exclude=.github ^
    --exclude=storage/app/public/* ^
    --exclude=storage/framework/cache/* ^
    --exclude=storage/framework/sessions/* ^
    --exclude=storage/framework/views/* ^
    --exclude=storage/logs/* ^
    --exclude=deployment-guides ^
    app bootstrap config database public resources routes storage ^
    artisan composer.json composer.lock package.json package-lock.json ^
    .htaccess README.md

echo ✓ 배포 파일 생성: %DEPLOY_FILE%

REM 7. 체크리스트
echo.
echo 7. 배포 전 체크리스트:
echo [ ] .env 파일 설정 확인
echo     - APP_ENV=production
echo     - APP_DEBUG=false
echo     - APP_URL=실제 도메인
echo     - 데이터베이스 정보
echo     - 토스페이먼츠 API 키
echo [ ] 서버에 %DEPLOY_FILE% 업로드
echo [ ] 서버에서 압축 해제
echo [ ] 서버에서 마이그레이션 실행: php artisan migrate
echo [ ] 서버에서 스토리지 링크: php artisan storage:link
echo [ ] 디렉토리 권한 설정: chmod -R 775 storage bootstrap/cache

echo.
echo ✅ 배포 준비 완료!
echo 자세한 배포 가이드는 deployment-guides\ 폴더를 참조하세요.
echo.
pause
