# 🐳 Docker Setup - Aplikasi Janji Temu Dosen

## Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) terinstall dan running
- Port yang tersedia: `8080`, `3307`, `6379`

## Quick Start

### 1. Build & Start Containers

```bash
docker-compose up -d --build
```

Ini akan membuat 4 container:
| Container | Service | Port |
|-----------|---------|------|
| `reservasi-app` | PHP 8.2 FPM | 9000 (internal) |
| `reservasi-webserver` | Nginx | 8080 |
| `reservasi-db` | MySQL 8.0 | 3307 |
| `reservasi-redis` | Redis 7 | 6379 |

### 2. Setup Laravel (pertama kali)

```bash
# Copy environment file
docker-compose exec app cp .env.docker .env

# Generate application key
docker-compose exec app php artisan key:generate

# Jalankan migrasi database + seeder
docker-compose exec app php artisan migrate --seed

# (Opsional) Link storage
docker-compose exec app php artisan storage:link
```

### 3. Akses Aplikasi

Buka browser → **http://localhost:8080**

## Perintah Berguna

```bash
# Lihat status container
docker-compose ps

# Lihat logs
docker-compose logs -f app
docker-compose logs -f webserver

# Masuk ke shell container app
docker-compose exec app bash

# Jalankan artisan command
docker-compose exec app php artisan migrate
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear

# Test Redis connection
docker-compose exec app php artisan tinker
# Lalu ketik: Cache::store('redis')->put('test', 'hello', 60);
# Lalu ketik: Cache::store('redis')->get('test');

# Restart semua container
docker-compose restart

# Stop semua container
docker-compose down

# Stop dan hapus semua data (termasuk database!)
docker-compose down -v
```

## Redis Usage

Redis digunakan untuk 3 hal:

| Fitur | Driver | Konfigurasi |
|-------|--------|-------------|
| **Cache** | `redis` | `CACHE_STORE=redis` |
| **Session** | `redis` | `SESSION_DRIVER=redis` |
| **Queue** | `redis` | `QUEUE_CONNECTION=redis` |

### Monitor Redis

```bash
# Masuk ke Redis CLI
docker-compose exec redis redis-cli

# Lihat semua keys
KEYS *

# Monitor real-time
MONITOR
```

## Troubleshooting

### Container tidak bisa start
```bash
# Cek logs
docker-compose logs app

# Rebuild dari awal
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

### Permission error pada storage/
```bash
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R www:www-data storage bootstrap/cache
```

### Database connection refused
Tunggu sampai MySQL container sepenuhnya ready (± 30 detik setelah start):
```bash
docker-compose exec db mysqladmin ping -h localhost -u root -psecret
```

### Redis connection refused
```bash
docker-compose exec redis redis-cli ping
# Harus return: PONG
```

## Pengembangan

Untuk development, file-file di-mount langsung ke container (bind mount), jadi perubahan kode langsung terlihat tanpa rebuild.

Jika mengubah Dockerfile atau docker-compose.yml:
```bash
docker-compose up -d --build
```

## Kembali ke XAMPP

Jika ingin kembali menggunakan XAMPP, cukup:
1. `docker-compose down`
2. Gunakan file `.env` yang asli (bukan `.env.docker`)
3. Start XAMPP seperti biasa
