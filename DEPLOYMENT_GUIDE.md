# 🚀 PRODUCTION DEPLOYMENT GUIDE
## Next Medya - Laravel Octane Optimized Setup

Bu guide'da **kusursuz bir production kurulumu** için tüm adımlar detaylandırılmıştır.

---

## 📋 İÇİNDEKİLER

1. [Sunucu Gereksinimleri](#1-sunucu-gereksinimleri)
2. [Redis Kurulumu](#2-redis-kurulumu-kritik)
3. [SSL Sertifikası (Cloudflare Origin)](#3-ssl-sertifikası-cloudflare-origin)
4. [PHP OPcache Optimizasyonu](#4-php-opcache-optimizasyonu)
5. [Nginx Konfigürasyonu](#5-nginx-konfigürasyonu)
6. [Supervisor Konfigürasyonu](#6-supervisor-konfigürasyonu)
7. [Laravel/Octane Ayarları](#7-laraveloctane-ayarları)
8. [Cloudflare Optimizasyonları](#8-cloudflare-optimizasyonları)
9. [Monitoring & Bakım](#9-monitoring--bakım)
10. [Sorun Giderme](#10-sorun-giderme)

---

## 1. SUNUCU GEREKSİNİMLERİ

### ✅ Minimum Gereksinimler:
- **OS:** Ubuntu 22.04+ / Debian 11+
- **PHP:** 8.2+ (8.3 önerilen)
- **Memory:** 2GB RAM (4GB+ önerilen)
- **CPU:** 2 cores (4+ önerilen)
- **Disk:** 20GB SSD

### 📦 Gerekli Paketler:
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y nginx mysql-server redis-server supervisor
sudo apt install -y php8.3-cli php8.3-fpm php8.3-mysql php8.3-redis \
  php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-bcmath \
  php8.3-intl php8.3-gd php8.3-swoole
```

---

## 2. REDIS KURULUMU (🔴 KRİTİK)

### Neden Redis Gerekli?
- ❌ **File-based cache:** Disk I/O bottleneck, memory leak riski
- ✅ **Redis cache:** 10-100x daha hızlı, worker'lar arası paylaşılan memory

### Kurulum:
```bash
# Redis server kur
sudo apt install redis-server -y

# PHP Redis extension kur
sudo apt install php8.3-redis -y

# Redis'i başlat ve enable et
sudo systemctl enable redis-server
sudo systemctl start redis-server

# Test et
redis-cli ping
# Beklenen output: PONG
```

### Redis Güvenlik Ayarları (Opsiyonel):
```bash
sudo nano /etc/redis/redis.conf
```

Aşağıdaki satırları bulup güncelleyin:
```conf
# Sadece localhost'tan erişim (güvenlik)
bind 127.0.0.1 ::1

# Şifre koruması (önerilen)
requirepass YOUR_STRONG_PASSWORD_HERE

# Memory limit (sunucu RAM'ine göre ayarlayın)
maxmemory 512mb
maxmemory-policy allkeys-lru
```

Redis'i restart edin:
```bash
sudo systemctl restart redis-server
```

---

## 3. SSL SERTİFİKASI (CLOUDFLARE ORIGIN)

### 🔒 Cloudflare Origin Certificate (15 Yıl Geçerli - ÖNERİLEN)

#### Adım 1: Cloudflare'de Sertifika Oluştur
1. Cloudflare Dashboard → **nextmedya.com** seçin
2. Sol menüden **SSL/TLS** → **Origin Server**
3. **Create Certificate** butonuna tıklayın
4. Ayarlar:
   - **Private key type:** RSA (2048)
   - **Hostnames:** `nextmedya.com` ve `*.nextmedya.com`
   - **Certificate Validity:** 15 years
5. **Create** butonuna tıklayın
6. **Origin Certificate** ve **Private Key**'i kopyalayın (sadece 1 kez gösterilir!)

#### Adım 2: Sunucuda Sertifikaları Kaydet
```bash
# SSL dizini oluştur
sudo mkdir -p /etc/ssl/cloudflare

# Certificate'i kaydet
sudo nano /etc/ssl/cloudflare/cert.pem
# Cloudflare'den kopyaladığınız "Origin Certificate"'i yapıştırın
# CTRL+X, Y, Enter ile kaydedin

# Private Key'i kaydet
sudo nano /etc/ssl/cloudflare/key.pem
# Cloudflare'den kopyaladığınız "Private Key"'i yapıştırın
# CTRL+X, Y, Enter ile kaydedin

# Dosya izinlerini güvenli hale getir
sudo chmod 600 /etc/ssl/cloudflare/*.pem
sudo chown root:root /etc/ssl/cloudflare/*.pem

# Test et
sudo openssl x509 -in /etc/ssl/cloudflare/cert.pem -text -noout
```

#### Adım 3: Cloudflare SSL Mode Ayarı
1. Cloudflare Dashboard → **SSL/TLS** → **Overview**
2. **Encryption mode:** **"Full (strict)"** seçin
   - ✅ Client ↔ Cloudflare: SSL
   - ✅ Cloudflare ↔ Origin: SSL (sertifika doğrulamalı)

---

## 4. PHP OPCACHE OPTİMİZASYONU

### OPcache Ayarları:
```bash
sudo nano /etc/php/8.3/cli/conf.d/10-opcache.ini
```

Aşağıdaki ayarları ekleyin/güncelleyin:
```ini
[opcache]
opcache.enable=1
opcache.enable_cli=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0
opcache.save_comments=1
opcache.fast_shutdown=1

; PHP 8.3 JIT (Just-In-Time Compiler)
opcache.jit=1255
opcache.jit_buffer_size=128M
```

### FPM Ayarları (Opsiyonel):
```bash
sudo nano /etc/php/8.3/fpm/conf.d/10-opcache.ini
```
(Aynı ayarları buraya da ekleyin)

### Değişiklikleri uygula:
```bash
sudo systemctl restart php8.3-fpm
```

---

## 5. NGINX KONFIGÜRASYONU

### Adım 1: Yeni Config'i Uygula
```bash
cd /var/www/nextmedya

# Repo'dan son değişiklikleri çek
git pull origin claude/fix-gzip-compression-01EDf72yraDeiVuJn8bZ9N9V

# Config'i nginx dizinine kopyala
sudo cp deploy/nginx/site.conf /etc/nginx/sites-available/nextmedya.conf

# Symlink oluştur
sudo ln -sf /etc/nginx/sites-available/nextmedya.conf /etc/nginx/sites-enabled/nextmedya.conf

# Eski config'leri kaldır
sudo rm -f /etc/nginx/sites-enabled/default
sudo rm -f /etc/nginx/sites-enabled/nextbilisim.conf

# Syntax kontrolü
sudo nginx -t

# Başarılıysa nginx'i restart et
sudo systemctl restart nginx
```

### Adım 2: SSL Sertifikalarını Kontrol Et
```bash
# Eğer SSL sertifikaları henüz yoksa, önce Bölüm 3'ü tamamlayın
ls -la /etc/ssl/cloudflare/

# Beklenen output:
# -rw------- 1 root root cert.pem
# -rw------- 1 root root key.pem
```

---

## 6. SUPERVISOR KONFIGÜRASYONU

### Adım 1: Supervisor Config'i Güncelle
```bash
cd /var/www/nextmedya

# Eski supervisor processlerini durdur
sudo supervisorctl stop all

# Yeni config'i kopyala
sudo cp deploy/supervisor/octane.conf /etc/supervisor/conf.d/nextmedya.conf

# Supervisor'ı reload et
sudo supervisorctl reread
sudo supervisorctl update

# Tüm processleri başlat
sudo supervisorctl start all

# Status kontrolü
sudo supervisorctl status
```

### Beklenen Output:
```
nextmedya:octane           RUNNING   pid 12345, uptime 0:00:10
nextmedya:queue-default_00 RUNNING   pid 12346, uptime 0:00:10
nextmedya:queue-default_01 RUNNING   pid 12347, uptime 0:00:10
nextmedya:queue-high_00    RUNNING   pid 12348, uptime 0:00:10
nextmedya:schedule         RUNNING   pid 12349, uptime 0:00:10
```

### Adım 2: Log Dosyalarını Kontrol Et
```bash
# Octane logları
tail -f /var/log/octane.log

# Queue logları
tail -f /var/log/queue-default.log

# Schedule logları
tail -f /var/log/schedule.log
```

---

## 7. LARAVEL/OCTANE AYARLARI

### Adım 1: Environment Dosyasını Güncelle
```bash
cd /var/www/nextmedya

# Mevcut .env dosyasını backup al
cp .env .env.backup.$(date +%Y%m%d)

# .env dosyasını düzenle
nano .env
```

Aşağıdaki değişiklikleri yapın:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://nextmedya.com

# Redis ayarları (KRİTİK!)
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null  # Eğer redis şifresi ayarladıysanız buraya yazın
REDIS_PORT=6379
REDIS_DB=0
REDIS_CACHE_DB=1
REDIS_SESSION_DB=2
REDIS_QUEUE_DB=3

# Octane ayarları
OCTANE_SERVER=swoole
OCTANE_HTTPS=true
OCTANE_MAX_REQUESTS=10000

# Logging (production için error level)
LOG_LEVEL=error
```

### Adım 2: Laravel Optimizasyonları
```bash
cd /var/www/nextmedya

# Cache'leri temizle
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Production cache'leri oluştur
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# File permissions düzelt
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Octane'i restart et
php artisan octane:reload
```

### Adım 3: Test Et
```bash
# Localhost'tan test
curl -I https://localhost

# Domain'den test (Cloudflare üzerinden)
curl -I https://nextmedya.com

# Redis bağlantısını test et
php artisan tinker
>>> Cache::put('test', 'success', 60);
>>> Cache::get('test');
# "success" dönmeli
>>> exit
```

---

## 8. CLOUDFLARE OPTİMİZASYONLARI

### 🔥 SSL/TLS Ayarları
1. **SSL/TLS** → **Overview**
   - Encryption mode: **Full (strict)**

2. **SSL/TLS** → **Edge Certificates**
   - ✅ Always Use HTTPS: **On**
   - ✅ HTTP Strict Transport Security (HSTS): **Enabled**
     - Max Age: 12 months
     - Include subdomains: Yes
     - Preload: Yes
   - ✅ Minimum TLS Version: **TLS 1.2**
   - ✅ TLS 1.3: **On**
   - ✅ Automatic HTTPS Rewrites: **On**

### ⚡ Speed Ayarları
1. **Speed** → **Optimization**
   - ✅ Auto Minify: HTML, CSS, JavaScript (hepsi aktif)
   - ✅ Brotli: **On**
   - ✅ Early Hints: **On**
   - ✅ Rocket Loader: **Off** (Laravel ile uyumlu değil)
   - ✅ HTTP/3 (with QUIC): **On**
   - ✅ 0-RTT Connection Resumption: **On**

### 🗂️ Caching Ayarları
1. **Caching** → **Configuration**
   - Caching Level: **Standard**
   - Browser Cache TTL: **4 hours** (veya ihtiyacınıza göre)
   - ✅ Always Online: **On**

2. **Caching** → **Cache Rules** (veya Page Rules)

#### Rule 1: Static Assets
```
URL Pattern: nextmedya.com/storage/*
veya: *.nextmedya.com/storage/*

Settings:
- Cache Level: Cache Everything
- Edge Cache TTL: 1 month
- Browser Cache TTL: 1 year
```

#### Rule 2: Admin Panel
```
URL Pattern: nextmedya.com/admin*

Settings:
- Cache Level: Bypass
- Security Level: High
```

#### Rule 3: API Endpoints
```
URL Pattern: nextmedya.com/api*

Settings:
- Cache Level: Bypass
```

### 🛡️ Security Ayarları
1. **Security** → **Settings**
   - Security Level: **Medium**
   - ✅ Bot Fight Mode: **On**
   - ✅ Challenge Passage: **30 minutes**
   - ✅ Browser Integrity Check: **On**

2. **Security** → **WAF** (Web Application Firewall)
   - ✅ Managed Rules: **On** (OWASP Core Ruleset)

### 🚀 Cache'i Temizle
**İlk deployment'tan sonra mutlaka yapın:**
1. Cloudflare Dashboard → **Caching** → **Configuration**
2. **Purge Everything** butonuna tıklayın
3. Onaylayın

---

## 9. MONITORING & BAKIM

### 📊 Log Rotation Ayarları
```bash
sudo nano /etc/logrotate.d/nextmedya
```

Aşağıdaki içeriği ekleyin:
```
/var/www/nextmedya/storage/logs/*.log {
    daily
    rotate 14
    compress
    delaycompress
    notifempty
    missingok
    create 0640 www-data www-data
}

/var/log/octane.log
/var/log/queue-*.log
/var/log/schedule.log {
    daily
    rotate 7
    compress
    delaycompress
    notifempty
    missingok
    create 0640 www-data www-data
}
```

Test et:
```bash
sudo logrotate -f /etc/logrotate.d/nextmedya
```

### 🔍 Monitoring Komutları
```bash
# Sistem kaynak kullanımı
htop

# Nginx status
sudo systemctl status nginx

# Redis status
sudo systemctl status redis-server
redis-cli info stats

# Supervisor processler
sudo supervisorctl status

# Octane logları (realtime)
tail -f /var/log/octane.log

# Disk kullanımı
df -h

# Memory kullanımı
free -h
```

### 🔄 Düzenli Bakım Görevleri

#### Günlük:
```bash
# Log dosyalarını kontrol et
sudo supervisorctl tail -f nextmedya:octane

# Hata loglarını kontrol et
tail -100 /var/www/nextmedya/storage/logs/laravel.log
```

#### Haftalık:
```bash
# Cache temizliği (gerekirse)
php artisan cache:clear

# Octane restart (memory temizliği için)
php artisan octane:reload

# Cloudflare cache purge (büyük değişikliklerden sonra)
```

#### Aylık:
```bash
# Disk alanı kontrolü
sudo du -sh /var/www/nextmedya/*

# Eski log dosyalarını temizle (2 aydan eski)
sudo find /var/www/nextmedya/storage/logs/ -name "*.log" -mtime +60 -delete
```

---

## 10. SORUN GİDERME

### ❌ Problem: Nginx 502 Bad Gateway

**Sebep:** Octane çalışmıyor veya port 8000 dinlemiyor

**Çözüm:**
```bash
# Octane status kontrol
ps aux | grep octane

# Octane'i restart et
sudo supervisorctl restart nextmedya:octane

# Port dinlemesini kontrol et
sudo netstat -tlnp | grep 8000

# Octane log'larını kontrol et
tail -50 /var/log/octane.log
```

---

### ❌ Problem: SSL Certificate hatası

**Sebep:** Cloudflare Origin Certificate yüklenmemiş veya hatalı

**Çözüm:**
```bash
# Sertifika dosyalarını kontrol et
sudo ls -la /etc/ssl/cloudflare/

# Sertifika geçerliliğini test et
sudo openssl x509 -in /etc/ssl/cloudflare/cert.pem -text -noout | grep "Not After"

# Nginx config'i test et
sudo nginx -t

# Eğer hata varsa, Bölüm 3'ü tekrar kontrol edin
```

---

### ❌ Problem: Site yavaş, garbled characters

**Sebep:** Double compression (çözülmüş olmalı)

**Kontrol:**
```bash
# Response headers kontrol et
curl -I https://nextmedya.com | grep -i "content-encoding"

# Beklenen: Sadece "br" veya "gzip" (tek encoding)
# Eğer yoksa: Cloudflare compression'ı kontrol et
```

---

### ❌ Problem: Redis connection refused

**Sebep:** Redis çalışmıyor veya PHP extension yüklü değil

**Çözüm:**
```bash
# Redis status
sudo systemctl status redis-server

# Eğer stopped ise, başlat
sudo systemctl start redis-server

# PHP Redis extension kontrolü
php -m | grep redis

# Eğer yok ise, kur
sudo apt install php8.3-redis -y
sudo systemctl restart php8.3-fpm
php artisan octane:reload
```

---

### ❌ Problem: Queue işleri çalışmıyor

**Sebep:** Queue worker çalışmıyor veya Redis bağlantısı yok

**Çözüm:**
```bash
# Queue worker status
sudo supervisorctl status nextmedya:queue*

# Restart et
sudo supervisorctl restart nextmedya:queue-default:*

# Queue'da bekleyen işleri kontrol et
php artisan queue:work redis --once --verbose

# Queue log'larını incele
tail -50 /var/log/queue-default.log
```

---

## 📞 DESTEK & KAYNAKLAR

- **Laravel Octane Docs:** https://laravel.com/docs/octane
- **Swoole Docs:** https://www.swoole.co.uk/docs
- **Cloudflare Docs:** https://developers.cloudflare.com/
- **Nginx Docs:** https://nginx.org/en/docs/

---

## ✅ DEPLOYMENT CHECKLIST

Deployment'tan önce aşağıdaki listeyi kontrol edin:

- [ ] Redis kuruldu ve çalışıyor
- [ ] PHP Redis extension yüklü
- [ ] Cloudflare Origin Certificate oluşturuldu ve sunucuya yüklendi
- [ ] Nginx config güncellendi ve syntax kontrolü yapıldı
- [ ] Supervisor config güncellendi
- [ ] .env dosyası production ayarlarıyla güncellendi
- [ ] Laravel cache'leri oluşturuldu (config, route, view)
- [ ] File permissions düzgün (www-data:www-data)
- [ ] Octane çalışıyor ve port 8000'i dinliyor
- [ ] Queue workers çalışıyor
- [ ] Cloudflare SSL mode "Full (strict)"
- [ ] Cloudflare cache temizlendi
- [ ] Site test edildi (hem domain hem IP üzerinden)
- [ ] SSL sertifikası test edildi
- [ ] Rate limiting test edildi
- [ ] Log dosyaları izleniyor

---

**🎉 Deployment tamamlandı! Site artık production-ready durumda.**
