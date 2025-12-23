#!/bin/bash

# ============================================
# Laravel Octane Zero-Downtime Deploy Script
# ============================================
# Usage: ./deploy.sh [--quick]
# --quick: Skip composer and migrations

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration
APP_DIR="/var/www/nextmedya"
BRANCH="main"

echo -e "${BLUE}🚀 Starting deployment...${NC}"

cd $APP_DIR

# Quick mode check
QUICK_MODE=false
if [[ "$1" == "--quick" ]]; then
    QUICK_MODE=true
    echo -e "${YELLOW}⚡ Quick mode enabled - skipping composer and migrations${NC}"
fi

# 1. Pull latest code
echo -e "${YELLOW}📥 Pulling latest code from $BRANCH...${NC}"
git fetch origin
git reset --hard origin/$BRANCH

# 2. Install dependencies (skip in quick mode)
if [[ "$QUICK_MODE" == false ]]; then
    echo -e "${YELLOW}📦 Installing composer dependencies...${NC}"
    composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
    
    # Run migrations
    echo -e "${YELLOW}🗃️ Running migrations...${NC}"
    php artisan migrate --force
fi

# 3. Clear and cache everything
echo -e "${YELLOW}🧹 Clearing and rebuilding caches...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 4. Clear application cache
echo -e "${YELLOW}🗑️ Clearing application cache...${NC}"
php artisan cache:clear-app

# 5. Warm up caches
echo -e "${YELLOW}🔥 Warming up application caches...${NC}"
php artisan cache:warm

# 6. Reload Octane (zero-downtime)
echo -e "${YELLOW}♻️ Reloading Octane workers...${NC}"
php artisan octane:reload

# 7. Restart queue workers
echo -e "${YELLOW}👷 Restarting queue workers...${NC}"
php artisan queue:restart

echo -e "${GREEN}✅ Deployment completed successfully!${NC}"
echo -e "${GREEN}🌐 Site is live at: https://nextmedya.com${NC}"
