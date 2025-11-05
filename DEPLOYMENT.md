# Production Deployment Guide

This guide provides step-by-step instructions for deploying this Laravel application to production.

---

## Pre-Deployment Checklist

### ✅ Required Services
- [ ] Web server (Nginx/Apache)
- [ ] PHP 8.3+ with required extensions
- [ ] MariaDB/MySQL 11+
- [ ] Redis (recommended for production)
- [ ] SSL Certificate (Let's Encrypt)
- [ ] Composer installed
- [ ] Node.js & npm (for assets)

### ✅ Server Requirements

**PHP Extensions**:
```bash
php -m | grep -E 'mbstring|dom|fileinfo|mysql|gd|bcmath|zip|redis'
```

**Memory & Performance**:
- PHP Memory Limit: 256M minimum
- PHP Max Execution Time: 300s
- PHP Max Upload Size: 64M
- MariaDB InnoDB Buffer Pool: 256M+ (adjust based on RAM)

---

## Step 1: Server Preparation

### 1.1 Install Dependencies (Ubuntu/Debian)

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install PHP 8.3 and extensions
sudo apt install -y php8.3-fpm php8.3-cli php8.3-common \
  php8.3-mysql php8.3-mbstring php8.3-xml php8.3-bcmath \
  php8.3-curl php8.3-gd php8.3-zip php8.3-redis

# Install MariaDB
sudo apt install -y mariadb-server mariadb-client

# Install Redis
sudo apt install -y redis-server

# Install Nginx
sudo apt install -y nginx

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js 20 LTS
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

### 1.2 Configure MariaDB

```bash
sudo mysql_secure_installation

# Create database and user
sudo mysql -u root -p
```

```sql
CREATE DATABASE alcaofficial CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'alcaofficial'@'localhost' IDENTIFIED BY 'STRONG_PASSWORD_HERE';
GRANT ALL PRIVILEGES ON alcaofficial.* TO 'alcaofficial'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 1.3 Configure Redis

```bash
# Edit Redis configuration
sudo nano /etc/redis/redis.conf

# Set password (recommended)
requirepass YOUR_REDIS_PASSWORD

# Restart Redis
sudo systemctl restart redis-server
sudo systemctl enable redis-server
```

---

## Step 2: Application Deployment

### 2.1 Clone Repository

```bash
# Create application directory
sudo mkdir -p /var/www/alcaofficial
sudo chown -R $USER:$USER /var/www/alcaofficial
cd /var/www/alcaofficial

# Clone from Git
git clone https://github.com/your-username/alcaofficial.git .

# Or upload files via SFTP/SCP
```

### 2.2 Install Dependencies

```bash
# Install PHP dependencies (production)
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies
npm ci

# Build frontend assets
npm run build
```

### 2.3 Configure Environment

```bash
# Copy production environment file
cp .env.production.example .env

# Edit environment variables
nano .env
```

**Critical .env settings**:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_DATABASE=alcaofficial
DB_USERNAME=alcaofficial
DB_PASSWORD=YOUR_DB_PASSWORD

CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_PASSWORD=YOUR_REDIS_PASSWORD

SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict
```

### 2.4 Generate Application Key

```bash
php artisan key:generate --force
```

### 2.5 Run Database Migrations

```bash
# Run migrations
php artisan migrate --force

# Seed essential data (if needed)
php artisan db:seed --class=SettingsSeeder
```

### 2.6 Optimize Application

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Cache events
php artisan event:cache

# Optimize autoloader
composer dump-autoload --optimize
```

### 2.7 Set Permissions

```bash
# Set ownership
sudo chown -R www-data:www-data /var/www/alcaofficial

# Set directory permissions
sudo find /var/www/alcaofficial -type d -exec chmod 755 {} \;

# Set file permissions
sudo find /var/www/alcaofficial -type f -exec chmod 644 {} \;

# Set writable directories
sudo chmod -R 775 /var/www/alcaofficial/storage
sudo chmod -R 775 /var/www/alcaofficial/bootstrap/cache

# Ensure www-data can write to storage
sudo chgrp -R www-data /var/www/alcaofficial/storage
sudo chgrp -R www-data /var/www/alcaofficial/bootstrap/cache
```

---

## Step 3: Web Server Configuration

### 3.1 Nginx Configuration

```bash
# Create Nginx config
sudo nano /etc/nginx/sites-available/alcaofficial
```

**Nginx Config**:
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;

    server_name yourdomain.com www.yourdomain.com;
    root /var/www/alcaofficial/public;

    index index.php index.html;

    # SSL Configuration (after obtaining certificate)
    ssl_certificate /etc/letsencrypt/live/yourdomain.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/yourdomain.com/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;

    # Logging
    access_log /var/log/nginx/alcaofficial-access.log;
    error_log /var/log/nginx/alcaofficial-error.log;

    # PHP-FPM
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;

        # Increase timeouts for long-running requests
        fastcgi_read_timeout 300;
    }

    # Deny access to hidden files
    location ~ /\. {
        deny all;
    }

    # Static files caching
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }

    # Gzip compression
    gzip on;
    gzip_vary on;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml text/javascript;
}
```

### 3.2 Enable Site

```bash
# Create symbolic link
sudo ln -s /etc/nginx/sites-available/alcaofficial /etc/nginx/sites-enabled/

# Test configuration
sudo nginx -t

# Restart Nginx
sudo systemctl restart nginx
sudo systemctl enable nginx
```

### 3.3 Obtain SSL Certificate (Let's Encrypt)

```bash
# Install Certbot
sudo apt install -y certbot python3-certbot-nginx

# Obtain certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal is enabled by default
# Test renewal:
sudo certbot renew --dry-run
```

---

## Step 4: Queue Workers

### 4.1 Configure Supervisor

```bash
# Install Supervisor
sudo apt install -y supervisor

# Create worker configuration
sudo nano /etc/supervisor/conf.d/alcaofficial-worker.conf
```

**Supervisor Config**:
```ini
[program:alcaofficial-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/alcaofficial/artisan queue:work redis --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/alcaofficial/storage/logs/worker.log
stopwaitsecs=3600
```

### 4.2 Start Workers

```bash
# Reload Supervisor
sudo supervisorctl reread
sudo supervisorctl update

# Start workers
sudo supervisorctl start alcaofficial-worker:*

# Check status
sudo supervisorctl status
```

---

## Step 5: Scheduled Tasks (Cron)

```bash
# Edit crontab
sudo crontab -e -u www-data
```

**Add this line**:
```cron
* * * * * cd /var/www/alcaofficial && php artisan schedule:run >> /dev/null 2>&1
```

---

## Step 6: Monitoring & Logging

### 6.1 Log Rotation

```bash
# Create log rotation config
sudo nano /etc/logrotate.d/alcaofficial
```

```
/var/www/alcaofficial/storage/logs/*.log {
    daily
    missingok
    rotate 14
    compress
    delaycompress
    notifempty
    create 0640 www-data www-data
    sharedscripts
}
```

### 6.2 Health Check Monitoring

Set up monitoring to check `/api/health` endpoint:

```bash
# Example with cron + curl
*/5 * * * * curl -f https://yourdomain.com/api/health || echo "Health check failed" | mail -s "Alert" admin@yourdomain.com
```

---

## Step 7: Post-Deployment

### 7.1 Verify Installation

```bash
# Check application is running
curl -I https://yourdomain.com

# Check health endpoint
curl https://yourdomain.com/api/health

# Check queue workers
sudo supervisorctl status

# Check logs
tail -f /var/www/alcaofficial/storage/logs/laravel.log
```

### 7.2 Performance Testing

```bash
# Install Apache Bench (optional)
sudo apt install -y apache2-utils

# Test endpoint performance
ab -n 1000 -c 10 https://yourdomain.com/api/v1/posts
```

---

## Maintenance Commands

### Clear Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Rebuild Caches
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Restart Queue Workers
```bash
php artisan queue:restart
sudo supervisorctl restart alcaofficial-worker:*
```

### Database Backup
```bash
# Manual backup
mysqldump -u alcaofficial -p alcaofficial > backup_$(date +%Y%m%d).sql

# Or use Laravel command
php artisan system:backup --format=sql
```

---

## Rollback Procedure

If deployment fails:

```bash
# 1. Switch to previous Git commit
git checkout <previous-commit-hash>

# 2. Reinstall dependencies
composer install --no-dev --optimize-autoloader

# 3. Rollback migrations (if needed)
php artisan migrate:rollback --step=1

# 4. Clear and rebuild caches
php artisan cache:clear
php artisan config:cache
php artisan route:cache

# 5. Restart workers
php artisan queue:restart
```

---

## Security Hardening

1. **Firewall**: Configure UFW/iptables
```bash
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw enable
```

2. **Fail2ban**: Install and configure
```bash
sudo apt install -y fail2ban
```

3. **Regular Updates**:
```bash
sudo apt update && sudo apt upgrade -y
```

4. **Disable Directory Listing**: Already handled in Nginx config

5. **Hide PHP Version**: Edit `php.ini`
```ini
expose_php = Off
```

---

## Monitoring Tools (Optional)

- **New Relic**: APM monitoring
- **Sentry**: Error tracking
- **Datadog**: Infrastructure monitoring
- **Grafana + Prometheus**: Metrics visualization

---

## Support

For deployment issues:
- Check logs: `/var/www/alcaofficial/storage/logs/`
- Nginx logs: `/var/log/nginx/`
- PHP-FPM logs: `/var/log/php8.3-fpm.log`

Contact: support@yourdomain.com
