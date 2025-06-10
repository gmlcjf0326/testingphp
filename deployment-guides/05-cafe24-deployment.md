# 카페24 웹호스팅 배포 가이드

## 📋 사전 준비사항
- 카페24 호스팅 계정 (PHP 호스팅 상품)
- FTP 클라이언트 (FileZilla 추천)
- SSH 접속 도구 (PuTTY 또는 터미널)

## 🛍️ 호스팅 상품 선택
### 추천 상품
- **광호스팅**: PHP 8.1 이상, MySQL 지원
- **단독서버호스팅**: 더 많은 제어권 필요 시
- 최소 요구사항: PHP 8.1, MySQL 5.7, 1GB 이상 용량

## 🚀 배포 절차

### 1. 카페24 호스팅 설정

#### PHP 버전 설정
1. 카페24 호스팅 센터 로그인
2. 나의 서비스 관리 → PHP 버전 관리
3. PHP 8.1 이상 선택

#### 데이터베이스 생성
1. 나의 서비스 관리 → MySQL 관리
2. DB 생성 클릭
3. 정보 기록:
   - DB명: `username_shop`
   - DB 사용자: `username`
   - DB 비밀번호: 설정한 비밀번호
   - DB 호스트: `localhost`

### 2. 로컬에서 준비 작업

#### 프로젝트 최적화
```bash
# Composer 패키지 최적화
composer install --optimize-autoloader --no-dev

# 프론트엔드 빌드
npm install
npm run build

# 캐시 생성
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### 환경 설정 파일 준비
`.env.production` 파일 생성:
```env
APP_NAME="Your Shop"
APP_ENV=production
APP_KEY=base64:your_generated_key_here
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=username_shop
DB_USERNAME=username
DB_PASSWORD=your_db_password

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=smtp.cafe24.com
MAIL_PORT=587
MAIL_USERNAME=your-email@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# 토스페이먼츠
TOSS_SANDBOX=true
TOSS_TEST_CLIENT_KEY=your_test_key
TOSS_TEST_SECRET_KEY=your_test_secret
```

### 3. 파일 업로드

#### 압축 파일 생성
```bash
# Windows
tar -czf shop-deploy.tar.gz ^
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
  app bootstrap config database public resources routes storage ^
  artisan composer.json composer.lock .htaccess
```

#### FTP 업로드
1. FileZilla로 접속:
   - 호스트: `ftp.yourdomain.com`
   - 사용자명: 카페24 FTP 아이디
   - 비밀번호: 카페24 FTP 비밀번호
   - 포트: 21

2. 업로드 위치:
   - `/www/` 또는 `/public_html/` 폴더에 업로드

#### SSH로 압축 해제 (SSH 지원 상품인 경우)
```bash
ssh username@yourdomain.com
cd /www
tar -xzf shop-deploy.tar.gz
rm shop-deploy.tar.gz
```

### 4. 서버에서 설정

#### .env 파일 설정
```bash
# .env.production을 .env로 복사
cp .env.production .env

# 또는 직접 생성
nano .env
```

#### 디렉토리 권한 설정
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

#### Composer 설치 (SSH 가능 시)
```bash
# Composer 다운로드
curl -sS https://getcomposer.org/installer | php

# 의존성 설치
php composer.phar install --optimize-autoloader --no-dev
```

#### 또는 카페24 Composer 매니저 사용
1. 호스팅 센터 → PHP 확장 모듈 → Composer
2. composer.json 업로드 후 실행

### 5. 데이터베이스 설정

#### SSH 접속 가능한 경우
```bash
php artisan migrate
php artisan db:seed # 필요시
```

#### phpMyAdmin 사용
1. 카페24 호스팅 센터 → MySQL 관리 → phpMyAdmin
2. SQL 파일 가져오기 또는 수동 실행

### 6. Document Root 설정

#### .htaccess 파일 (루트 디렉토리)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

#### public/.htaccess 확인
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

### 7. 심볼릭 링크 생성
SSH 접속 가능한 경우:
```bash
php artisan storage:link
```

불가능한 경우, 수동으로 생성:
1. FTP로 `public/storage` 폴더 생성
2. 심볼릭 링크 대신 실제 파일 복사 필요

### 8. 크론잡 설정 (스케줄러)
카페24 호스팅 센터 → 크론잡 관리:
```bash
* * * * * /usr/local/bin/php /home/username/www/artisan schedule:run >> /dev/null 2>&1
```

## 🔧 트러블슈팅

### 500 에러
1. PHP 버전 확인 (8.1 이상)
2. `.htaccess` 파일 확인
3. 에러 로그 확인:
   ```bash
   tail -f storage/logs/laravel.log
   ```

### 한글 깨짐 문제
1. 데이터베이스 문자셋 확인 (utf8mb4)
2. `.env` 파일 인코딩 확인 (UTF-8)

### 세션 문제
```bash
# storage/framework/sessions 폴더 권한
chmod 777 storage/framework/sessions
```

### 파일 업로드 크기 제한
카페24 호스팅 센터 → PHP 설정에서:
- `upload_max_filesize` 조정
- `post_max_size` 조정

## 📝 유지보수

### 배포 자동화 스크립트
`deploy.sh` 생성:
```bash
#!/bin/bash
# 로컬에서 실행

echo "🚀 카페24 배포 시작..."

# 빌드
npm run build
composer install --optimize-autoloader --no-dev

# 압축
tar -czf deploy.tar.gz \
  --exclude=node_modules \
  --exclude=.git \
  --exclude=.env \
  --exclude=storage/logs/* \
  app bootstrap config database public resources routes storage \
  artisan composer.json composer.lock .htaccess

# FTP 업로드 (lftp 사용)
lftp -u username,password ftp.yourdomain.com << EOF
cd /www
put deploy.tar.gz
quit
EOF

# SSH 명령 실행
ssh username@yourdomain.com << 'EOF'
cd /www
tar -xzf deploy.tar.gz
rm deploy.tar.gz
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
EOF

echo "✅ 배포 완료!"
```

### 백업
1. 카페24 자동 백업 서비스 활용
2. 수동 백업:
   ```bash
   # 데이터베이스 백업
   mysqldump -u username -p username_shop > backup_$(date +%Y%m%d).sql
   
   # 파일 백업
   tar -czf files_backup_$(date +%Y%m%d).tar.gz /www
   ```

## 🌐 도메인 및 SSL 설정

### 도메인 연결
1. 카페24 도메인 관리 → 네임서버 설정
2. A 레코드: 호스팅 서버 IP
3. CNAME: www → 도메인

### 무료 SSL 인증서
1. 카페24 호스팅 센터 → 보안서버(SSL) 인증서
2. Let's Encrypt 무료 인증서 신청
3. 자동 갱신 설정

### HTTPS 강제 적용
`.htaccess`에 추가:
```apache
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}/$1 [R=301,L]
```

## 💡 카페24 특화 팁

### 1. 속도 최적화
- 카페24 CDN 서비스 활용
- 이미지 최적화 (WebP 변환)
- Gzip 압축 활성화

### 2. 이메일 설정
카페24 SMTP 서버:
- 서버: `smtp.cafe24.com`
- 포트: 587 (TLS)
- 인증: 이메일 계정 정보

### 3. 모니터링
- 카페24 웹로그 분석 도구 활용
- 리소스 사용량 모니터링
- 트래픽 초과 알림 설정

### 4. 보안 강화
- 카페24 웹방화벽 활성화
- IP 차단 규칙 설정
- 정기적인 보안 업데이트

## 📞 지원
- 카페24 고객센터: 1588-4925
- 기술지원 게시판 활용
- 원격지원 서비스 (유료)
