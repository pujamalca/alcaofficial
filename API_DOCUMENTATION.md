# API Documentation

## Overview

This Laravel application provides a RESTful API for managing blog posts, pages, categories, and user authentication.

**Base URL**: `https://yourdomain.com/api`

**API Versions**:
- v1: `/api/v1/*` (Current stable version)
- v2: `/api/v2/*` (Future enhancements)

---

## Authentication

The API uses Laravel Sanctum for token-based authentication.

### Register
```http
POST /api/v1/auth/register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

### Login
```http
POST /api/v1/auth/login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "password123"
}
```

**Response**:
```json
{
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  },
  "meta": {
    "token": "1|xxxxxxxxxxxxx",
    "token_type": "Bearer"
  }
}
```

### Authenticated Requests
```http
GET /api/v1/auth/profile
Authorization: Bearer {token}
```

---

## Rate Limiting

All API endpoints are rate-limited to prevent abuse:

| Endpoint Type | Rate Limit | Duration |
|---------------|------------|----------|
| Public Content | 60 requests | per minute |
| Login | 5 attempts | per 5 minutes |
| Register | 60 requests | per minute |
| Content Write | 10 requests | per minute |
| Comments | 20 requests | per minute |

**Response Headers**:
```
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Retry-After: 60 (when rate limit exceeded)
```

---

## Response Caching

GET requests are automatically cached for better performance:

| Endpoint | Cache Duration |
|----------|----------------|
| Posts List | 10 minutes |
| Post Detail | 30 minutes |
| Pages | 60 minutes |

**Cache Headers**:
```
X-Cache: HIT (served from cache)
X-Cache: MISS (fresh from database)
X-Cache-TTL: 600 (time-to-live in seconds)
```

---

## Request Tracking

All requests include a unique request ID for debugging:

**Response Header**:
```
X-Request-ID: 550e8400-e29b-41d4-a716-446655440000
```

Use this ID when reporting issues or debugging errors.

---

## Posts API

### List Posts
```http
GET /api/v1/posts
```

**Query Parameters**:
- `search` (string): Search posts by title, content, or excerpt
- `category_slug` (string): Filter by category
- `tag` (string|int): Filter by tag slug or ID
- `author` (string): Filter by author username/email
- `per_page` (int): Items per page (1-50, default: 15)
- `sort` (string): Sort field (`published_at`, `created_at`, `view_count`)
- `direction` (string): Sort direction (`asc`, `desc`)
- `is_featured` (boolean): Filter featured posts

**Example**:
```http
GET /api/v1/posts?search=laravel&per_page=20&sort=view_count&direction=desc
```

**Response**:
```json
{
  "data": [
    {
      "id": 1,
      "title": "Getting Started with Laravel",
      "slug": "getting-started-with-laravel",
      "excerpt": "Learn the basics of Laravel...",
      "content": "Full content here...",
      "featured_image": "/storage/images/post-1.jpg",
      "status": "published",
      "view_count": 1250,
      "reading_time": 5,
      "published_at": "2025-01-01T10:00:00+00:00",
      "category": {
        "id": 1,
        "name": "Technology",
        "slug": "technology"
      },
      "author": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
      },
      "links": {
        "self": "/api/v1/posts/getting-started-with-laravel",
        "author": "/api/v1/users/1",
        "category": "/api/v1/categories/technology",
        "comments": "/api/v1/posts/getting-started-with-laravel/comments"
      }
    }
  ],
  "links": {
    "first": "/api/v1/posts?page=1",
    "last": "/api/v1/posts?page=10",
    "prev": null,
    "next": "/api/v1/posts?page=2"
  },
  "meta": {
    "current_page": 1,
    "last_page": 10,
    "per_page": 15,
    "total": 150,
    "from": 1,
    "to": 15
  }
}
```

### Get Single Post
```http
GET /api/v1/posts/{slug}
```

### Create Post (Authenticated)
```http
POST /api/v1/posts
Authorization: Bearer {token}
Content-Type: application/json

{
  "title": "My New Post",
  "content": "Post content here...",
  "excerpt": "Short description",
  "category_id": 1,
  "status": "published",
  "is_featured": false,
  "tags": [1, 2, 3]
}
```

### Update Post (Authenticated)
```http
PUT /api/v1/posts/{post_id}
Authorization: Bearer {token}
Content-Type: application/json
```

### Delete Post (Authenticated)
```http
DELETE /api/v1/posts/{post_id}
Authorization: Bearer {token}
```

---

## Search API

Global search across all posts:

```http
GET /api/search?q=laravel
```

**Query Parameters**:
- `q` (string, required): Search query (min: 2, max: 100 characters)

**Features**:
- Full-text search (MySQL FULLTEXT index)
- SQL injection protected
- Searches in: title, content, excerpt
- Returns max 10 results

---

## Health Check

Monitor API health status:

```http
GET /api/health
```

**Response**:
```json
{
  "status": "healthy",
  "timestamp": "2025-11-05T18:30:00+00:00",
  "services": {
    "database": "ok",
    "cache": "ok",
    "queue": "ok",
    "queue_size": 0
  }
}
```

**Status Codes**:
- `200`: All services healthy
- `503`: One or more services unhealthy

---

## Error Handling

All errors follow a consistent format:

```json
{
  "message": "Error description",
  "errors": {
    "field": ["Validation error message"]
  }
}
```

**Status Codes**:
- `200`: Success
- `201`: Created
- `204`: No Content (delete success)
- `400`: Bad Request
- `401`: Unauthorized
- `403`: Forbidden
- `404`: Not Found
- `422`: Validation Error
- `429`: Too Many Requests (rate limit)
- `500`: Server Error
- `503`: Service Unavailable

---

## HATEOAS Links

All resource responses include hypermedia links for better API discoverability:

```json
{
  "data": {
    "id": 1,
    "title": "Post Title",
    "links": {
      "self": "/api/v1/posts/post-slug",
      "author": "/api/v1/users/1",
      "category": "/api/v1/categories/tech",
      "comments": "/api/v1/posts/post-slug/comments"
    }
  }
}
```

---

## Best Practices

### 1. Always Use HTTPS in Production
```
https://yourdomain.com/api/v1/posts
```

### 2. Include Accept Header
```http
Accept: application/json
```

### 3. Handle Rate Limits
Check `X-RateLimit-Remaining` header and implement exponential backoff when approaching limits.

### 4. Cache Responses Client-Side
Respect `X-Cache` headers and implement client-side caching when appropriate.

### 5. Use Request IDs for Debugging
Include `X-Request-ID` when reporting issues.

### 6. Validate Input
Always validate and sanitize user input before sending to API.

---

## OpenAPI/Swagger Documentation

Interactive API documentation is available at:
```
https://yourdomain.com/api/documentation
```

To regenerate documentation:
```bash
php artisan l5-swagger:generate
```

---

## Support

For issues or questions:
- GitHub Issues: https://github.com/your-repo/issues
- Email: support@yourdomain.com
