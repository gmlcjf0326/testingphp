#!/bin/bash
# quick-deploy.sh - 빠른 배포를 위한 스크립트

echo "🚀 Laravel 쇼핑몰 배포 준비 스크립트"
echo "=================================="

# 색상 정의
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# 1. 환경 확인
echo -e "\n${YELLOW}1. 환경 확인 중...${NC}"
php_version=$(php -v | head -n 1)
node_version=$(node -v)
npm_version=$(npm -v)

echo "PHP 버전: $php_version"
echo "Node 버전: $node_version"
echo "NPM 버전: $npm_version"

# 2. .env 파일 확인
echo -e "\n${YELLOW}2. 환경 설정 파일 확인...${NC}"
if [ ! -f .env ]; then
    cp .env.example .env
    echo -e "${GREEN}✓ .env 파일 생성됨${NC}"
    echo -e "${RED}⚠️  .env 파일을 수정해주세요!${NC}"
else
    echo -e "${GREEN}✓ .env 파일 존재${NC}"
fi

# 3. 의존성 설치
echo -e "\n${YELLOW}3. 의존성 설치...${NC}"
echo "Composer 패키지 설치 중..."
composer install --optimize-autoloader --no-dev

echo "NPM 패키지 설치 중..."
npm install

# 4. 프론트엔드 빌드
echo -e "\n${YELLOW}4. 프론트엔드 빌드...${NC}"
npm run build

# 5. Laravel 최적화
echo -e "\n${YELLOW}5. Laravel 최적화...${NC}"

# 키 생성 (필요한 경우)
if ! grep -q "APP_KEY=base64:" .env; then
    php artisan key:generate
    echo -e "${GREEN}✓ 앱 키 생성됨${NC}"
fi

# 캐시 생성
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo -e "${GREEN}✓ 캐시 생성 완료${NC}"

# 6. 배포 파일 생성
echo -e "\n${YELLOW}6. 배포 파일 생성...${NC}"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
DEPLOY_FILE="deploy_${TIMESTAMP}.tar.gz"

tar -czf $DEPLOY_FILE \
    --exclude=node_modules \
    --exclude=.git \
    --exclude=.env \
    --exclude=tests \
    --exclude=.github \
    --exclude='storage/app/public/*' \
    --exclude='storage/framework/cache/*' \
    --exclude='storage/framework/sessions/*' \
    --exclude='storage/framework/views/*' \
    --exclude='storage/logs/*' \
    --exclude=deployment-guides \
    app bootstrap config database public resources routes storage \
    artisan composer.json composer.lock package.json package-lock.json \
    .htaccess README.md

echo -e "${GREEN}✓ 배포 파일 생성: $DEPLOY_FILE${NC}"

# 7. 체크리스트
echo -e "\n${YELLOW}7. 배포 전 체크리스트:${NC}"
echo "[ ] .env 파일 설정 확인"
echo "    - APP_ENV=production"
echo "    - APP_DEBUG=false"
echo "    - APP_URL=실제 도메인"
echo "    - 데이터베이스 정보"
echo "    - 토스페이먼츠 API 키"
echo "[ ] 서버에 $DEPLOY_FILE 업로드"
echo "[ ] 서버에서 압축 해제"
echo "[ ] 서버에서 마이그레이션 실행: php artisan migrate"
echo "[ ] 서버에서 스토리지 링크: php artisan storage:link"
echo "[ ] 디렉토리 권한 설정: chmod -R 775 storage bootstrap/cache"

echo -e "\n${GREEN}✅ 배포 준비 완료!${NC}"
echo -e "자세한 배포 가이드는 ${YELLOW}deployment-guides/${NC} 폴더를 참조하세요."
