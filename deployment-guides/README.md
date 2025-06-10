# 🚀 Laravel 쇼핑몰 배포 가이드

ANUTA 스타일 UI와 토스페이먼츠 결제가 구현된 Laravel 쇼핑몰 프로젝트의 배포 가이드입니다.

## 📋 배포 옵션 비교

| 옵션 | 난이도 | 비용 | 성능 | 확장성 | 추천 대상 |
|------|--------|------|------|---------|-----------|
| **카페24** | ⭐⭐ | 💰💰 | ⚡⚡ | 📈📈 | 한국 시장, 초보자 |
| **전통 호스팅** | ⭐⭐ | 💰 | ⚡ | 📈 | 소규모 프로젝트 |
| **VPS** | ⭐⭐⭐⭐ | 💰💰💰 | ⚡⚡⚡⚡ | 📈📈📈📈 | 중대형 프로젝트 |
| **Heroku** | ⭐ | 💰💰💰💰 | ⚡⚡⚡ | 📈📈📈 | 빠른 프로토타입 |

## 🎯 빠른 시작

### 1. 초보자/소규모 프로젝트
**→ 카페24 또는 전통적인 웹 호스팅 추천**
- 간단한 설정
- 한국어 지원
- 합리적인 가격

### 2. 중급자/성장 가능성 있는 프로젝트
**→ VPS (Vultr, DigitalOcean) 추천**
- 완전한 서버 제어
- 좋은 성능
- 확장 가능

### 3. 빠른 테스트/프로토타입
**→ Heroku 또는 Railway 추천**
- 가장 빠른 배포
- Git push로 배포
- 비용 주의 필요

## 📁 가이드 목록

1. **[배포 전 체크리스트](01-deployment-checklist.md)**
   - 모든 배포에 공통으로 필요한 준비사항
   - 보안 설정, 환경 변수, 최적화

2. **[전통적인 웹 호스팅](02-traditional-hosting.md)**
   - 일반적인 공유 호스팅 서비스
   - FTP 업로드 방식

3. **[VPS 배포](03-vps-deployment.md)**
   - Ubuntu 서버 기준
   - Nginx + PHP-FPM 설정

4. **[Heroku 배포](04-heroku-deployment.md)**
   - PaaS 서비스 활용
   - Git 기반 배포

5. **[카페24 배포](05-cafe24-deployment.md)**
   - 한국 호스팅 서비스
   - 한국어 지원

## ⚡ 빠른 배포 명령어

### 로컬 준비
```bash
# 1. 프론트엔드 빌드
npm install && npm run build

# 2. PHP 의존성 최적화
composer install --optimize-autoloader --no-dev

# 3. 캐시 생성
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. 환경 파일 준비
cp .env.example .env.production
# .env.production 수정 필요
```

### 서버 설정 (공통)
```bash
# 1. 파일 업로드 후
php artisan key:generate

# 2. 데이터베이스 마이그레이션
php artisan migrate

# 3. 스토리지 링크
php artisan storage:link

# 4. 권한 설정
chmod -R 775 storage bootstrap/cache
```

## 🔐 프로덕션 전환 시 필수 확인사항

### 토스페이먼츠 실제 결제 전환
```env
# .env 파일에서 변경
TOSS_SANDBOX=false
TOSS_CLIENT_KEY=live_ck_실제키  # test_ck_ → live_ck_
TOSS_SECRET_KEY=live_sk_실제키  # test_sk_ → live_sk_
```

### 보안 설정
- [ ] APP_DEBUG=false
- [ ] 실제 도메인으로 APP_URL 변경
- [ ] HTTPS 적용
- [ ] 강력한 비밀번호 사용

## 🆘 문제 해결

### 일반적인 문제
1. **500 에러**: 로그 확인 `storage/logs/laravel.log`
2. **권한 오류**: `chmod -R 775 storage`
3. **페이지 못 찾음**: `.htaccess` 파일 확인

### 지원 받기
- Laravel 공식 문서: https://laravel.com/docs
- 토스페이먼츠 개발자센터: https://developers.tosspayments.com
- 각 호스팅 업체 고객센터

## 💡 추가 개발 예정 기능
- 이메일 알림 시스템
- 재고 관리
- 주문 취소/환불 기능
- 배송 추적
- 관리자 대시보드

---

**작성일**: 2025-06-10  
**프로젝트**: ANUTA 스타일 Laravel 쇼핑몰
