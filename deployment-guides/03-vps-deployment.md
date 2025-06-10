# VPS 배포 가이드 (Ubuntu 22.04 LTS)

## 📋 요구사항
- Ubuntu 22.04 LTS 서버
- 최소 1GB RAM (2GB 권장)
- 최소 20GB 디스크 공간
- root 또는 sudo 권한

## 🚀 배포 절차

### 1. 서버 초기 설정

#### 시스템 업데이트
```bash
sudo apt update
sudo apt upgrade -y
```

#### 방화벽 설정
```bash
sudo ufw allow OpenSSH
sudo ufw allow 80
sudo ufw allow 443
sudo ufw enable
```

#### 새 사용자 생성 (선택사항)
```bash
sudo adduser deploy
sudo usermod -aG sudo deploy
```

### 2. 필수 소프트웨어 설치

#### Nginx 설치
```bash
sudo apt install nginx -y
sudo systemctl start nginx
sudo systemctl enable nginx
```

#### PHP 8.1 및 확장 설치
```bash
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

sudo apt install php8.1-fpm php8.1-cli php8.1-common php8.1-mysql \
php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml \
php8.1-bcmath php8.1-intl -y
```

#### MySQL 설치
```bash
sudo apt install mysql-server -y
sudo mysql_secure_installation
```

#### Composer 설치
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
```

#### Node.js 및 NPM 설치
```bash
curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
sudo apt install nodejs -y
```

#### Git 설치
```bash
sudo apt install git -y
```

### 3. MySQL 데이터베이스 설정

```bash
sudo mysql

# MySQL 내에서 실행
CREATE DATABASE shop_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'shop_user'@'localhost' IDENTIFIED BY 'strong_password_here';
GRANT ALL PRIVILEGES ON shop_db.* TO 'shop_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 4. 프로젝트 배포

#### 프로젝트 클론
```bash
cd /var/www
sudo git clone https://github.com/yourusername/shop-project.git
sudo chown -R www-data:www-data /var/www/shop-project
```

#### 또는 직접 업로드
```bash
# 로컬에서
scp -r shop-project deploy@your-server-ip:/var/www/
```

#### 프로젝트 설정
```bash
cd /var/www/shop-project

# .env 파일 생성
sudo cp .env.example .env
sudo nano .env
```

`.env` 파일 수정:
```env
APP_NAME="Your Shop"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shop_db
DB_USERNAME=shop_user
DB_PASSWORD=strong_password_here

# 토스페이먼츠 설정
TOSS_SANDBOX=true
TOSS_TEST_CLIENT_KEY=your_test_client_key
TOSS_TEST_SECRET_KEY=your_test_secret_key
```

#### 의존성 설치 및 설정
```bash
# Composer 의존성 설치
sudo composer install --optimize-autoloader --no-dev

# 키 생성
sudo php artisan key:generate

# 권한 설정
sudo chown -R www-data:www-data /var/www/shop-project
sudo chmod -R 755 /var/www/shop-project
sudo chmod -R 775 /var/www/shop-project/storage
sudo chmod -R 775 /var/www/shop-project/bootstrap/cache

# 마이그레이션
sudo php artisan migrate

# 심볼릭 링크
sudo php artisan storage:link

# 캐시 최적화
sudo php artisan config:cache
sudo php artisan route:cache
sudo php artisan view:cache

# 프론트엔드 빌드
npm install
npm run build
```

### 5. Nginx 설정

```bash
sudo nano /etc/nginx/sites-available/shop
```

Nginx 설정 파일:
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/shop-project/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

심볼릭 링크 생성 및 테스트:
```bash
sudo ln -s /etc/nginx/sites-available/shop /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### 6. SSL 설정 (Let's Encrypt)

```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

### 7. 크론 작업 설정

```bash
sudo crontab -e
```

추가:
```cron
* * * * * cd /var/www/shop-project && php artisan schedule:run >> /dev/null 2>&1
```

### 8. 큐 워커 설정 (선택사항)

Supervisor 설치:
```bash
sudo apt install supervisor -y
```

Supervisor 설정:
```bash
sudo nano /etc/supervisor/conf.d/shop-worker.conf
```

```ini
[program:shop-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/shop-project/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/shop-project/storage/logs/worker.log
stopwaitsecs=3600
```

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start shop-worker:*
```

## 🔧 트러블슈팅

### 권한 문제
```bash
# storage 폴더 권한 재설정
sudo chown -R www-data:www-data /var/www/shop-project
sudo find /var/www/shop-project -type f -exec chmod 644 {} \;
sudo find /var/www/shop-project -type d -exec chmod 755 {} \;
sudo chmod -R 775 /var/www/shop-project/storage
sudo chmod -R 775 /var/www/shop-project/bootstrap/cache
```

### PHP-FPM 소켓 문제
```bash
# PHP-FPM 상태 확인
sudo systemctl status php8.1-fpm

# 소켓 위치 확인
ls -la /var/run/php/
```

### 502 Bad Gateway
1. PHP-FPM이 실행 중인지 확인
2. Nginx 에러 로그 확인: `sudo tail -f /var/log/nginx/error.log`
3. PHP-FPM 로그 확인: `sudo tail -f /var/log/php8.1-fpm.log`

## 📝 유지보수

### 업데이트 절차
```bash
cd /var/www/shop-project

# 유지보수 모드
php artisan down

# 코드 업데이트
git pull origin main

# 의존성 업데이트
composer install --optimize-autoloader --no-dev
npm install && npm run build

# 마이그레이션
php artisan migrate

# 캐시 재생성
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 유지보수 모드 해제
php artisan up
```

### 백업 스크립트
```bash
#!/bin/bash
# backup.sh

TIMESTAMP=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/home/deploy/backups"

# 데이터베이스 백업
mysqldump -u shop_user -p shop_db > $BACKUP_DIR/db_$TIMESTAMP.sql

# 파일 백업
tar -czf $BACKUP_DIR/files_$TIMESTAMP.tar.gz /var/www/shop-project

# 7일 이상 된 백업 삭제
find $BACKUP_DIR -type f -mtime +7 -delete
```

### 모니터링
```bash
# 시스템 리소스
htop

# Nginx 로그
tail -f /var/log/nginx/access.log
tail -f /var/log/nginx/error.log

# Laravel 로그
tail -f /var/www/shop-project/storage/logs/laravel.log

# 디스크 사용량
df -h

# 메모리 사용량
free -m
```

## 🎯 성능 최적화

### PHP-FPM 튜닝
```bash
sudo nano /etc/php/8.1/fpm/pool.d/www.conf
```

주요 설정:
```ini
pm = dynamic
pm.max_children = 50
pm.start_servers = 5
pm.min_spare_servers = 5
pm.max_spare_servers = 35
pm.max_requests = 500
```

### MySQL 튜닝
```bash
sudo nano /etc/mysql/mysql.conf.d/mysqld.cnf
```

추가:
```ini
[mysqld]
innodb_buffer_pool_size = 256M
innodb_log_file_size = 64M
max_connections = 100
query_cache_type = 1
query_cache_size = 32M
```

### Redis 캐시 (선택사항)
```bash
sudo apt install redis-server -y
sudo systemctl enable redis-server
```

`.env` 파일에서 캐시 드라이버 변경:
```env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
```
