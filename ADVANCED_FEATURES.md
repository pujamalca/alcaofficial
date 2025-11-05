# Advanced Features Guide

Complete guide untuk fitur-fitur advanced Phase 5.

---

## Table of Contents

1. [Real-Time Features (Broadcasting)](#real-time-features)
2. [Meilisearch (Ultra-Fast Search)](#meilisearch)
3. [Image Optimization](#image-optimization)
4. [Docker Setup](#docker-setup)
5. [Analytics Dashboard](#analytics-dashboard)

---

## Real-Time Features

### Overview

Real-time features menggunakan Laravel Broadcasting dengan support untuk:
- **Pusher** (Cloud service)
- **Reverb** (Laravel's official WebSocket server)
- **Redis** (Self-hosted)

### Setup Broadcasting

#### 1. Install Dependencies

```bash
# For Pusher
composer require pusher/pusher-php-server

# For Laravel Reverb (Recommended)
composer require laravel/reverb
php artisan reverb:install

# Frontend
npm install --save-dev laravel-echo pusher-js
```

#### 2. Configure .env

```env
# Pusher Configuration
BROADCAST_CONNECTION=pusher
PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-key
PUSHER_APP_SECRET=your-secret
PUSHER_APP_CLUSTER=mt1

# Or Laravel Reverb
BROADCAST_CONNECTION=reverb
REVERB_APP_ID=local-app-id
REVERB_APP_KEY=local-key
REVERB_APP_SECRET=local-secret
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http
```

#### 3. Available Events

**PostCreatedEvent** - Real-time post notifications
```php
// Broadcasts to: Channel('posts')
// Event name: 'post.created'
// Data: post details, message, timestamp
```

**CommentCreatedEvent** - Real-time comments
```php
// Broadcasts to: Channel('posts.{post_id}')
// Event name: 'comment.created'
// Data: comment details, post_id, timestamp
```

### Frontend Integration

```javascript
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Listen for new posts
Echo.channel('posts')
    .listen('.post.created', (e) => {
        console.log('New post:', e.post);
        // Update UI
    });

// Listen for new comments on a specific post
Echo.channel(`posts.${postId}`)
    .listen('.comment.created', (e) => {
        console.log('New comment:', e.comment);
        // Update comments list
    });
```

### Use Cases

✅ Live notifications for new posts
✅ Real-time comments
✅ Live dashboard updates
✅ User presence (who's online)
✅ Live analytics

---

## Meilisearch

### Overview

Meilisearch provides **ultra-fast, typo-tolerant search** with response times <50ms.

**Features**:
- ⚡ Search results in <50ms
- 🔤 Typo-tolerant
- 🎯 Faceted search (filters)
- 📊 Search suggestions
- 🌍 Multi-language support

### Installation

```bash
# Install Scout
composer require laravel/scout

# Install Meilisearch driver
composer require meilisearch/meilisearch-php

# Publish config
php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"
```

### Docker Setup

Meilisearch is already included in `docker-compose.yml`:

```bash
docker-compose up -d meilisearch
```

Access dashboard: http://localhost:7700

### Configuration

File: `config/scout.php`

Already configured with:
- Searchable attributes: title, content, excerpt
- Filterable: status, category_id, author_id, is_featured
- Sortable: published_at, view_count, created_at

### Usage

#### Index Posts

```bash
# Import all posts to Meilisearch
php artisan scout:import "App\Models\Post"

# Or use queue
php artisan scout:import "App\Models\Post" --queue
```

#### Search

```php
use App\Models\Post;

// Simple search
$posts = Post::search('laravel')->get();

// With filters
$posts = Post::search('laravel')
    ->where('status', 'published')
    ->where('is_featured', true)
    ->get();

// Paginated
$posts = Post::search('laravel')
    ->paginate(15);

// With sorting
$posts = Post::search('laravel')
    ->orderBy('published_at', 'desc')
    ->get();
```

#### API Endpoint

```bash
# Search via API
GET /api/v1/posts?search=laravel

# With Meilisearch (faster)
GET /api/search?q=laravel
```

### Performance

| Method | Response Time | Notes |
|--------|---------------|-------|
| MySQL LIKE | 200-500ms | Slow on large datasets |
| MySQL FULLTEXT | 50-100ms | Good for basic search |
| **Meilisearch** | **<50ms** | ⚡ Ultra-fast, typo-tolerant |

---

## Image Optimization

### Overview

Automatic image optimization using Spatie Image Optimizer.

**Benefits**:
- 🎨 70-90% smaller file sizes
- 🚀 Faster page loads
- 💾 Reduced bandwidth costs
- ✅ Automatic optimization

### Installation

```bash
# Install package
composer require spatie/laravel-image-optimizer

# Install optimization tools (Ubuntu/Debian)
sudo apt-get install jpegoptim optipng pngquant gifsicle webp

# Or macOS
brew install jpegoptim optipng pngquant gifsicle webp
```

### Configuration

File: `config/image-optimizer.php`

Configured optimizers:
- **JPEG**: jpegoptim (85% quality, progressive)
- **PNG**: pngquant + optipng
- **GIF**: gifsicle (level 3)
- **WebP**: cwebp (quality 90)
- **SVG**: svgo

### Usage

#### Automatic Optimization

```php
use Spatie\ImageOptimizer\OptimizerChainFactory;

$optimizerChain = OptimizerChainFactory::create();

// Optimize single image
$optimizerChain->optimize($pathToImage);

// Optimize on upload
$request->file('image')->store('images');
$optimizerChain->optimize(storage_path('app/images/' . $filename));
```

#### With Media Library

```php
// In Post model
public function registerMediaConversions(): void
{
    $this->addMediaConversion('thumb')
        ->width(300)
        ->height(300)
        ->optimize(); // Automatic optimization
}
```

### Example Results

| Original | Optimized | Savings |
|----------|-----------|---------|
| 2.5 MB JPEG | 650 KB | 74% |
| 1.8 MB PNG | 320 KB | 82% |
| 450 KB GIF | 180 KB | 60% |

---

## Docker Setup

### Overview

Complete Docker environment with:
- PHP 8.3 (FPM)
- Nginx
- MariaDB 11
- Redis 7
- Meilisearch
- Queue Worker
- Scheduler
- Mailpit (email testing)
- Prometheus
- Grafana

### Quick Start

```bash
# Copy environment file
cp .env.example .env

# Start all services
docker-compose up -d

# Install dependencies
docker-compose exec app composer install

# Generate key
docker-compose exec app php artisan key:generate

# Run migrations
docker-compose exec app php artisan migrate --seed

# Access application
open http://localhost:8000
```

### Services

| Service | Port | URL |
|---------|------|-----|
| **App** | 8000 | http://localhost:8000 |
| **Mailpit UI** | 8025 | http://localhost:8025 |
| **Meilisearch** | 7700 | http://localhost:7700 |
| **Prometheus** | 9090 | http://localhost:9090 |
| **Grafana** | 3000 | http://localhost:3000 |
| **MariaDB** | 3306 | localhost:3306 |
| **Redis** | 6379 | localhost:6379 |

### Useful Commands

```bash
# View logs
docker-compose logs -f app

# Execute commands
docker-compose exec app php artisan migrate

# Queue worker
docker-compose exec app php artisan queue:work

# Stop all services
docker-compose down

# Rebuild containers
docker-compose up -d --build
```

### Production Deployment

```bash
# Build for production
docker-compose -f docker-compose.prod.yml up -d --build

# Scale workers
docker-compose up -d --scale queue=3
```

---

## Analytics Dashboard

### Overview

Comprehensive analytics dashboard with real-time metrics.

**Features**:
- 📊 Real-time metrics
- 📈 Posts growth charts
- 👥 User behavior tracking
- 🔥 Popular content
- 📥 Exportable reports (JSON/CSV)

### API Endpoints

```bash
# Dashboard summary
GET /api/analytics/dashboard

# Posts growth chart (30 days)
GET /api/analytics/posts-growth

# Traffic chart (7 days)
GET /api/analytics/traffic

# Category distribution
GET /api/analytics/categories

# Export report
GET /api/analytics/export?format=csv
GET /api/analytics/export?format=json
```

### Dashboard Summary Response

```json
{
  "success": true,
  "data": {
    "posts": {
      "total": 150,
      "published": 120,
      "draft": 25,
      "scheduled": 5,
      "total_views": 45230,
      "avg_views_per_post": 377
    },
    "users": {
      "total": 1250,
      "active_today": 45,
      "new_this_week": 12,
      "new_this_month": 58
    },
    "traffic": {
      "views_today": 1520,
      "views_this_week": 8940,
      "views_this_month": 35720,
      "unique_visitors_today": 890
    },
    "popular_posts": [
      {
        "id": 1,
        "title": "Getting Started with Laravel",
        "slug": "getting-started-laravel",
        "views": 5430,
        "published_at": "2025-01-15"
      }
    ]
  }
}
```

### Frontend Integration (Chart.js)

```html
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="trafficChart"></canvas>

<script>
// Fetch data
fetch('/api/analytics/traffic')
  .then(res => res.json())
  .then(data => {
    new Chart(document.getElementById('trafficChart'), {
      type: 'line',
      data: {
        labels: data.data.labels,
        datasets: [
          {
            label: 'Views',
            data: data.data.views,
            borderColor: 'rgb(75, 192, 192)',
          },
          {
            label: 'Unique Visitors',
            data: data.data.unique_visitors,
            borderColor: 'rgb(255, 99, 132)',
          }
        ]
      }
    });
  });
</script>
```

### Caching

All analytics are cached:
- Dashboard summary: 5 minutes
- Chart data: 10 minutes
- Category distribution: 10 minutes

Cache is automatically cleared when new posts are published.

---

## Next Steps

### Recommended Order

1. ✅ Setup Docker environment
2. ✅ Configure Meilisearch
3. ✅ Setup Broadcasting (Reverb/Pusher)
4. ✅ Test Analytics Dashboard
5. ✅ Configure Image Optimization

### Optional Enhancements

- Add WebSocket authentication
- Implement private channels
- Add real-time user presence
- Create Grafana dashboards
- Setup CDN for images

---

## Support

For questions:
- Documentation: This file
- Laravel Docs: https://laravel.com/docs
- Meilisearch Docs: https://www.meilisearch.com/docs
- Docker Docs: https://docs.docker.com

Email: support@yourdomain.com
