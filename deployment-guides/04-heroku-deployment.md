# Heroku 배포 가이드

## 📋 사전 준비사항
- Heroku 계정 (https://www.heroku.com)
- Heroku CLI 설치 (https://devcenter.heroku.com/articles/heroku-cli)
- Git 설치

## 🚀 배포 절차

### 1. Heroku CLI 로그인
```bash
heroku login
```

### 2. Heroku 프로젝트 생성
```bash
cd C:\xampp\htdocs\mysite\newphp\shop-project
heroku create your-shop-name
```

### 3. Heroku 설정 파일 생성

#### Procfile 생성
```bash
echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile
```

#### 또는 Nginx 사용 시:
```bash
echo "web: vendor/bin/heroku-php-nginx public/" > Procfile
```

### 4. 빌드팩 설정
```bash
heroku buildpacks:set heroku/php
heroku buildpacks:add heroku/nodejs
```

### 5. 데이터베이스 추가
```bash
# PostgreSQL 추가 (무료 플랜)
heroku addons:create heroku-postgresql:mini

# 또는 MySQL (ClearDB, 유료)
heroku addons:create cleardb:ignite
```

### 6. 환경 변수 설정
```bash
# 앱 키 생성
heroku config:set APP_KEY=$(php artisan key:generate --show)

# 기본 설정
heroku config:set APP_NAME="Your Shop Name"
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_URL=https://your-shop-name.herokuapp.com

# Laravel 설정
heroku config:set LOG_CHANNEL=errorlog
heroku config:set SESSION_DRIVER=cookie
heroku config:set CACHE_DRIVER=file

# 토스페이먼츠 설정
heroku config:set TOSS_SANDBOX=true
heroku config:set TOSS_TEST_CLIENT_KEY=your_test_client_key
heroku config:set TOSS_TEST_SECRET_KEY=your_test_secret_key
```

### 7. 데이터베이스 설정 수정

#### PostgreSQL 사용 시
`config/database.php` 수정:
```php
'pgsql' => [
    'driver' => 'pgsql',
    'url' => env('DATABASE_URL'),
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '5432'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8',
    'prefix' => '',
    'prefix_indexes' => true,
    'schema' => 'public',
    'sslmode' => 'prefer',
],
```

`config/database.php` 상단에 추가:
```php
$DATABASE_URL = parse_url(env('DATABASE_URL', ''));

if ($DATABASE_URL) {
    config([
        'database.connections.pgsql.host' => $DATABASE_URL['host'] ?? null,
        'database.connections.pgsql.port' => $DATABASE_URL['port'] ?? null,
        'database.connections.pgsql.database' => ltrim($DATABASE_URL['path'] ?? '', '/'),
        'database.connections.pgsql.username' => $DATABASE_URL['user'] ?? null,
        'database.connections.pgsql.password' => $DATABASE_URL['pass'] ?? null,
    ]);
}
```

### 8. package.json 수정
`package.json`에 다음 스크립트 추가:
```json
{
  "scripts": {
    "dev": "vite",
    "build": "vite build",
    "heroku-postbuild": "npm run build"
  }
}
```

### 9. composer.json 수정
`composer.json`에 다음 추가:
```json
{
  "scripts": {
    "post-install-cmd": [
      "php artisan clear-compiled",
      "php artisan optimize",
      "chmod -R 777 storage"
    ]
  }
}
```

### 10. HTTPS 강제 설정
`app/Providers/AppServiceProvider.php`:
```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
```

### 11. Git 커밋 및 배포
```bash
# .gitignore 확인 (vendor, node_modules 제외)
git add .
git commit -m "Prepare for Heroku deployment"

# Heroku에 배포
git push heroku main
```

### 12. 데이터베이스 마이그레이션
```bash
heroku run php artisan migrate
```

### 13. 스토리지 링크 생성
```bash
heroku run php artisan storage:link
```

## 🔧 트러블슈팅

### 빌드 실패
1. `composer.lock` 파일이 Git에 포함되었는지 확인
2. PHP 버전 지정 (`composer.json`):
```json
{
  "require": {
    "php": "^8.1"
  }
}
```

### 500 에러
```bash
# 로그 확인
heroku logs --tail

# 환경 변수 확인
heroku config

# 캐시 클리어
heroku run php artisan cache:clear
heroku run php artisan config:clear
```

### 정적 파일 문제
1. `npm run build`가 정상적으로 실행되었는지 확인
2. `public/build` 폴더가 생성되었는지 확인

### 파일 업로드 문제
Heroku의 ephemeral 파일시스템 때문에 업로드된 파일이 사라집니다.
AWS S3 또는 Cloudinary 같은 외부 스토리지 사용 필요:

```bash
# AWS S3 설정
heroku config:set AWS_ACCESS_KEY_ID=your_key
heroku config:set AWS_SECRET_ACCESS_KEY=your_secret
heroku config:set AWS_DEFAULT_REGION=ap-northeast-2
heroku config:set AWS_BUCKET=your-bucket-name
```

## 📝 유지보수

### 배포 업데이트
```bash
git add .
git commit -m "Update message"
git push heroku main

# 필요시 마이그레이션
heroku run php artisan migrate
```

### 유지보수 모드
```bash
# 활성화
heroku run php artisan down

# 비활성화
heroku run php artisan up
```

### 데이터베이스 백업
```bash
# PostgreSQL 백업
heroku pg:backups:capture
heroku pg:backups:download
```

### 로그 모니터링
```bash
# 실시간 로그
heroku logs --tail

# 특정 프로세스 로그
heroku logs --source app --tail
```

## 🎯 최적화 및 확장

### 성능 최적화
1. **Redis 캐시 추가**:
```bash
heroku addons:create heroku-redis:mini
heroku config:set CACHE_DRIVER=redis
heroku config:set SESSION_DRIVER=redis
```

2. **CDN 설정** (Cloudflare):
- Cloudflare에 도메인 추가
- Heroku custom domain 설정
- SSL 설정

### 스케일링
```bash
# 다이노 수 증가
heroku ps:scale web=2

# 다이노 타입 변경
heroku ps:resize web=standard-1x
```

### 커스텀 도메인
```bash
# 도메인 추가
heroku domains:add www.yourdomain.com
heroku domains:add yourdomain.com

# DNS 설정 확인
heroku domains
```

## 💰 비용 고려사항

### 무료 플랜 제한
- 월 550시간 무료 (인증 시 1000시간)
- 30분 비활성 시 슬립 모드
- 커스텀 도메인 SSL 미지원

### 추천 유료 플랜
- **Eco Dyno**: $5/월 (슬립 모드 없음)
- **Basic Database**: $9/월
- **Redis Cache**: $15/월

### 대안 PaaS
- Railway (더 저렴한 옵션)
- Render (무료 플랜 제공)
- DigitalOcean App Platform

## 📌 주의사항
1. Heroku는 2022년 11월부터 무료 플랜을 중단했습니다
2. 파일 업로드는 외부 스토리지 필수
3. 한국 리전이 없어 레이턴시 고려 필요
4. 장기적으로는 VPS나 클라우드 이전 검토
