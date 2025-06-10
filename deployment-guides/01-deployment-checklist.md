# 배포 전 체크리스트

## 🎯 배포 전 필수 확인사항

### 1. 환경 설정 (.env)
- [ ] `APP_ENV=production` 변경
- [ ] `APP_DEBUG=false` 변경
- [ ] `APP_KEY` 설정 확인 (없으면 `php artisan key:generate`)
- [ ] `APP_URL` 실제 도메인으로 변경
- [ ] 데이터베이스 정보를 실제 운영 DB로 변경
- [ ] 토스페이먼츠 실제 API 키로 변경 (프로덕션 전환 시)
  ```env
  TOSS_SANDBOX=false
  TOSS_CLIENT_KEY=live_ck_실제키
  TOSS_SECRET_KEY=live_sk_실제키
  ```

### 2. 보안 설정
- [ ] `.env` 파일이 절대 Git에 포함되지 않도록 확인
- [ ] 모든 민감한 정보가 환경 변수로 관리되는지 확인
- [ ] HTTPS 설정 준비

### 3. 성능 최적화
```bash
# 설정 캐시
php artisan config:cache

# 라우트 캐시
php artisan route:cache

# 뷰 캐시
php artisan view:cache

# 오토로더 최적화
composer install --optimize-autoloader --no-dev
```

### 4. 프론트엔드 빌드
```bash
# Node.js 패키지 설치
npm install

# 프로덕션 빌드
npm run build
```

### 5. 데이터베이스
- [ ] 운영 DB 생성
- [ ] 마이그레이션 실행 준비
- [ ] 초기 데이터 시딩 준비 (필요한 경우)

### 6. 파일 권한
```bash
# storage와 bootstrap/cache에 쓰기 권한 필요
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 7. 필수 PHP 확장
- PHP >= 8.1
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- Filter PHP Extension
- Hash PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Session PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

### 8. 웹서버 설정
- Apache: `.htaccess` 파일 확인
- Nginx: 설정 파일 준비

## 📦 배포 파일 준비

### 포함해야 할 파일/폴더
- `/app`
- `/bootstrap`
- `/config`
- `/database`
- `/public`
- `/resources`
- `/routes`
- `/storage` (구조만, 내용은 제외)
- `/.htaccess`
- `/artisan`
- `/composer.json`
- `/composer.lock`
- `/package.json`
- `/package-lock.json`

### 제외해야 할 파일/폴더
- `/.env`
- `/node_modules`
- `/vendor` (서버에서 composer install로 설치)
- `/.git`
- `/tests`
- `/storage/app/public/*`
- `/storage/framework/cache/*`
- `/storage/framework/sessions/*`
- `/storage/framework/views/*`
- `/storage/logs/*`

## 🚀 배포 옵션

1. **전통적인 웹 호스팅** (카페24, 가비아 등)
   - 장점: 간단, 저렴
   - 단점: 제한적인 서버 설정

2. **VPS/클라우드** (AWS EC2, Vultr, DigitalOcean)
   - 장점: 완전한 서버 제어
   - 단점: 서버 관리 필요

3. **PaaS** (Heroku, Railway)
   - 장점: 간편한 배포
   - 단점: 비용, 제한사항

4. **한국 클라우드** (NCP, KT Cloud)
   - 장점: 국내 서비스, 빠른 속도
   - 단점: 비용

## 다음 단계
각 배포 옵션별 상세 가이드를 참조하세요:
- `02-traditional-hosting.md` - 전통적인 웹 호스팅
- `03-vps-deployment.md` - VPS 배포
- `04-heroku-deployment.md` - Heroku 배포
- `05-cafe24-deployment.md` - 카페24 배포
