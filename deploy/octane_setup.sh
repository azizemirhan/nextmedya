#!/bin/bash
# ============================================
# Next Medya - Sunucu Kurulum Scripti
# ============================================
# Bu script sunucuda ilk kurulum için kullanılır
# Kullanım: bash octane_setup.sh
#
# ÖNEMLİ: Bu script SEBEKİNDE KURULUM içindir.
# Normal deployment için GitHub Actions kullanılır.
# ============================================

set -e

echo "� Next Medya Sunucu Kurulumu Başlıyor..."

# Renk tanımları
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

# 1. PHP versiyonunu tespit et
PHP_VERSION=$(php -v | head -n 1 | cut -d ' ' -f 2 | cut -d '.' -f 1,2)
echo -e "${YELLOW}PHP versiyonu: $PHP_VERSION${NC}"

# 2. Gerekli PHP eklentilerini kur
echo -e "${YELLOW}📦 Gerekli PHP eklentileri kuruluyor...${NC}"
apt update
apt install -y php${PHP_VERSION}-xml php${PHP_VERSION}-redis php${PHP_VERSION}-mysql php${PHP_VERSION}-mbstring php${PHP_VERSION}-curl

# 3. Swoole kurulumu kontrol et
if php -m | grep -q swoole; then
    echo -e "${GREEN}✅ Swoole zaten kurulu${NC}"
else
    echo -e "${YELLOW}📦 Swoole kuruluyor...${NC}"
    apt install -y php${PHP_VERSION}-dev php-pear build-essential
    pecl install swoole
    echo "extension=swoole.so" > /etc/php/${PHP_VERSION}/cli/conf.d/20-swoole.ini
fi

# 4. max_input_vars ayarla
if ! grep -q "max_input_vars = 10000" /etc/php/${PHP_VERSION}/cli/php.ini; then
    echo "max_input_vars = 10000" >> /etc/php/${PHP_VERSION}/cli/php.ini
    echo -e "${GREEN}✅ max_input_vars ayarlandı${NC}"
fi

# 5. Storage izinlerini düzelt
echo -e "${YELLOW}🔐 Storage izinleri düzeltiliyor...${NC}"
chown -R www-data:www-data /var/www/nextmedya/storage
chown -R www-data:www-data /var/www/nextmedya/bootstrap/cache
chmod -R 775 /var/www/nextmedya/storage
chmod -R 775 /var/www/nextmedya/bootstrap/cache

# 6. Supervisor config oluştur (Octane)
echo -e "${YELLOW}⚙️ Supervisor config oluşturuluyor...${NC}"
cat > /etc/supervisor/conf.d/octane.conf << 'EOF'
[program:octane]
process_name=%(program_name)s_%(process_num)02d
command=/usr/bin/php /var/www/nextmedya/artisan octane:start --server=swoole --host=127.0.0.1 --port=8000
directory=/var/www/nextmedya
user=www-data
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
redirect_stderr=true
stdout_logfile=/var/log/octane.log
stopwaitsecs=30
numprocs=1
EOF

# 7. Supervisor'ı yeniden yükle
echo -e "${YELLOW}♻️ Supervisor yeniden yükleniyor...${NC}"
supervisorctl reread
supervisorctl update

# 8. Octane'i başlat
supervisorctl start octane:*

echo ""
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}✅ Kurulum Tamamlandı!${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""
echo "Servis durumu:"
supervisorctl status
echo ""
echo -e "${YELLOW}Not: Nginx config zaten Octane için yapılandırılmış.${NC}"
echo -e "${YELLOW}Site: https://nextmedya.com${NC}"
