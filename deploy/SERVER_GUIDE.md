# Next Medya - Sunucu Mimarisi ve Deployment Rehberi

## 🏗️ Sunucu Mimarisi

| Bileşen             | Değer                                    |
| ------------------- | ---------------------------------------- |
| **Sunucu**          | Hetzner CX23 (2 vCPU, 4GB RAM, 40GB SSD) |
| **IP**              | `167.235.141.242`                        |
| **OS**              | Ubuntu 24.04 LTS                         |
| **PHP**             | 8.3 + Swoole                             |
| **Web Server**      | Nginx (Cloudflare SSL)                   |
| **Uygulama**        | Laravel Octane (Swoole)                  |
| **Veritabanı**      | MySQL                                    |
| **Cache/Queue**     | Redis                                    |
| **Process Manager** | Supervisor                               |

---

## 📁 Dizin Yapısı

```
/var/www/nextmedya/          # Laravel proje dizini
/etc/nginx/sites-enabled/    # Nginx config
/etc/supervisor/conf.d/      # Supervisor config (octane, queue)
/etc/ssl/cloudflare/         # SSL sertifikaları
/var/log/octane.log          # Octane log dosyası
```

---

## 🔄 CI/CD - Otomatik Deployment

### Nasıl Çalışır?

1. Lokalde kod değişikliği yap
2. `git push origin main`
3. GitHub Actions otomatik tetiklenir
4. Sunucuya SSH ile bağlanır ve deploy eder

### GitHub Secrets (Gerekli)

| Secret            | Değer                   |
| ----------------- | ----------------------- |
| `SERVER_IP`       | `167.235.141.242`       |
| `SERVER_USER`     | `root`                  |
| `SSH_PRIVATE_KEY` | SSH private key içeriği |

---

## 💾 Veritabanı Export/Import

### Lokalde Export (Docker)

```bash
docker exec nextmedya_db mysqldump --no-tablespaces -u nextmedya -psecret nextmedya > nextmedya_backup.sql
```

### Sunucuya Gönder

```bash
scp nextmedya_backup.sql root@167.235.141.242:/tmp/
```

### Sunucuda Import

```bash
ssh root@167.235.141.242
mysql -u nextmedya -pNextMedya2024Secure nextmedya < /tmp/nextmedya_backup.sql
```

---

## 🛠️ Sunucu Yönetimi

### SSH ile Bağlan

```bash
ssh root@167.235.141.242
```

### Octane Yönetimi

```bash
supervisorctl status                    # Tüm servislerin durumu
supervisorctl restart octane:*          # Octane yeniden başlat
supervisorctl restart queue-default:*   # Queue workers yeniden başlat
```

### Cache Temizleme

```bash
cd /var/www/nextmedya
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Log Kontrol

```bash
cat /var/log/octane.log                          # Octane log
tail -f /var/www/nextmedya/storage/logs/laravel.log  # Laravel log
```

### İzin Düzeltme (Sorun Olursa)

```bash
chown -R www-data:www-data /var/www/nextmedya/storage
chmod -R 775 /var/www/nextmedya/storage
```

---

## ⚠️ Sorun Giderme

### 502 Bad Gateway

- Octane çalışmıyor olabilir: `supervisorctl status`
- Yeniden başlat: `supervisorctl restart octane:*`

### Permission Denied

- Storage izinlerini düzelt: `chown -R www-data:www-data storage`

### Menü/İçerik Görünmüyor

- Cache temizle: `php artisan cache:clear && php artisan view:clear`
- Octane reload: `supervisorctl restart octane:*`
