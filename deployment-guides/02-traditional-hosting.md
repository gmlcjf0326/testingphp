# 전통적인 웹 호스팅 배포 가이드

## 📋 요구사항
- PHP 8.1 이상
- MySQL 5.7 이상 또는 MariaDB 10.3 이상
- Composer 지원
- SSH 접근 (권장)

## 🚀 배포 절차

### 1. 호스팅 준비
1. 호스팅 업체에서 계정 생성
2. 도메인 연결
3. SSL 인증서 설정 (Let's Encrypt 무료 SSL 권장)

### 2. 데이터베이스 생성
1. 호스팅 제어판에서 MySQL 데이터베이스 생성
2. 데이터베이스 사용자 생성 및 권한 부여
3. 정보 기록:
   - DB 이름: `your_db_name`
   - DB 사용자: `your_db_user`
   - DB 비밀번호: `your_db_password`
   - DB 호스트: `localhost` 또는 제공된 호스트

### 3. 파일 업로드
#### FTP/SFTP 사용
```bash
# FileZilla 또는 다른 FTP 클라이언트 사용
# public_html 또는 www 폴더에 업로드

# 제외 항목:
# - node_modules/
# - vendor/
# - .env
# - .git/
```

#### 압축 파일 업로드 (권장)
1. 로컬에서 압축:
```bash
# Windows
tar -czf shop-project.tar.gz --exclude=node_modules --exclude=vendor --exclude=.env --exclude=.git app bootstrap config database public resources routes storage artisan composer.json composer.lock package.json package-lock.json
```

2. 호스팅 서버에 업로드 후 압축 해제:
```bash
tar -xzf shop-project.tar.gz
```

### 4. Composer 의존성 설치
SSH 접속 후:
```bash
cd /path/to/your/project
php composer.phar install --optimize-autoloader --no-dev
```

또는 호스팅 제어판의 Composer 관리자 사용

### 5. 환경 설정
1. `.env.example`을 `.env`로 복사
```bash
cp .env.example .env
```

2. `.env` 파일 수정:
```env
APP_NAME="Your Shop Name"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

# 토스페이먼츠 (테스트 모드 유지 또는 실제 키로 변경)
TOSS_SANDBOX=true
TOSS_TEST_CLIENT_KEY=test_ck_your_key
TOSS_TEST_SECRET_KEY=test_sk_your_key

# 메일 설정 (SMTP)
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

3. 애플리케이션 키 생성:
```bash
php artisan key:generate
```

### 6. 데이터베이스 마이그레이션
```bash
php artisan migrate
```

초기 데이터가 필요한 경우:
```bash
php artisan db:seed
```

### 7. 디렉토리 권한 설정
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 8. 심볼릭 링크 생성
```bash
php artisan storage:link
```

### 9. 캐시 최적화
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 10. 프론트엔드 빌드
로컬에서 빌드 후 업로드하거나, 서버에서 직접 빌드:
```bash
npm install
npm run build
```

### 11. 웹서버 설정

#### Apache (.htaccess)
`public/.htaccess` 파일 확인:
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

#### Document Root 설정
호스팅 제어판에서 Document Root를 `/public` 폴더로 설정

## 🔧 트러블슈팅

### 500 Internal Server Error
1. `.env` 파일 확인
2. `storage` 폴더 권한 확인
3. PHP 버전 확인
4. 에러 로그 확인: `storage/logs/laravel.log`

### 데이터베이스 연결 오류
1. `.env` 파일의 DB 정보 확인
2. 데이터베이스 사용자 권한 확인
3. 호스팅 업체의 DB 접근 제한 확인

### 페이지를 찾을 수 없음 (404)
1. `.htaccess` 파일 확인
2. `mod_rewrite` 활성화 확인
3. Document Root 설정 확인

## 📝 유지보수

### 업데이트 절차
1. 로컬에서 변경사항 테스트
2. 백업 생성
3. 유지보수 모드 활성화: `php artisan down`
4. 파일 업로드
5. 데이터베이스 마이그레이션: `php artisan migrate`
6. 캐시 재생성
7. 유지보수 모드 해제: `php artisan up`

### 로그 관리
정기적으로 로그 파일 확인 및 정리:
```bash
# 로그 확인
tail -f storage/logs/laravel.log

# 오래된 로그 삭제
find storage/logs -name "*.log" -mtime +30 -delete
```

## 🎯 성능 최적화
1. PHP OPcache 활성화
2. MySQL 쿼리 캐시 활성화
3. CDN 사용 고려 (정적 파일)
4. 이미지 최적화
