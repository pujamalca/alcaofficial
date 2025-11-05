<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AnalyticsService
{
    /**
     * Get dashboard analytics summary
     */
    public function getDashboardSummary(): array
    {
        return Cache::remember('analytics:dashboard:summary', 300, function () {
            return [
                'posts' => $this->getPostsAnalytics(),
                'users' => $this->getUsersAnalytics(),
                'traffic' => $this->getTrafficAnalytics(),
                'popular_posts' => $this->getPopularPosts(),
                'recent_activity' => $this->getRecentActivity(),
            ];
        });
    }

    /**
     * Get posts analytics
     */
    protected function getPostsAnalytics(): array
    {
        return [
            'total' => Post::count(),
            'published' => Post::where('status', 'published')->count(),
            'draft' => Post::where('status', 'draft')->count(),
            'scheduled' => Post::where('status', 'scheduled')->count(),
            'total_views' => Post::sum('view_count'),
            'avg_views_per_post' => round(Post::avg('view_count')),
        ];
    }

    /**
     * Get users analytics
     */
    protected function getUsersAnalytics(): array
    {
        return [
            'total' => User::count(),
            'active_today' => $this->getActiveUsersToday(),
            'new_this_week' => User::where('created_at', '>=', now()->subWeek())->count(),
            'new_this_month' => User::where('created_at', '>=', now()->subMonth())->count(),
        ];
    }

    /**
     * Get traffic analytics
     */
    protected function getTrafficAnalytics(): array
    {
        $today = now()->format('Y-m-d');

        return [
            'views_today' => $this->getViewsCount($today),
            'views_this_week' => $this->getViewsCount(now()->subWeek()->format('Y-m-d')),
            'views_this_month' => $this->getViewsCount(now()->subMonth()->format('Y-m-d')),
            'unique_visitors_today' => $this->getUniqueVisitorsCount($today),
        ];
    }

    /**
     * Get popular posts
     */
    protected function getPopularPosts(int $limit = 10): array
    {
        return Post::where('status', 'published')
            ->orderBy('view_count', 'desc')
            ->limit($limit)
            ->get(['id', 'title', 'slug', 'view_count', 'published_at'])
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'views' => $post->view_count,
                    'published_at' => $post->published_at?->format('Y-m-d'),
                ];
            })
            ->toArray();
    }

    /**
     * Get recent activity
     */
    protected function getRecentActivity(int $limit = 10): array
    {
        return Post::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get(['id', 'title', 'slug', 'view_count', 'published_at'])
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'views' => $post->view_count,
                    'published_at' => $post->published_at?->diffForHumans(),
                ];
            })
            ->toArray();
    }

    /**
     * Get views count since date
     */
    protected function getViewsCount(string $since): int
    {
        $pattern = "post_views:*:{$since}*";

        try {
            $total = 0;
            $keys = Cache::getStore()->getRedis()->keys($pattern);

            foreach ($keys as $key) {
                $total += (int) Cache::get($key, 0);
            }

            return $total;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Get unique visitors count
     */
    protected function getUniqueVisitorsCount(string $date): int
    {
        $pattern = "post_unique_count:*:{$date}";

        try {
            $total = 0;
            $keys = Cache::getStore()->getRedis()->keys($pattern);

            foreach ($keys as $key) {
                $total += (int) Cache::get($key, 0);
            }

            return $total;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Get active users today
     */
    protected function getActiveUsersToday(): int
    {
        // This would require user activity tracking
        // For now, return a placeholder
        return Cache::get('analytics:active_users:today', 0);
    }

    /**
     * Get posts growth chart data (last 30 days)
     */
    public function getPostsGrowthChart(): array
    {
        return Cache::remember('analytics:posts:growth:30days', 600, function () {
            $data = [];

            for ($i = 29; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $count = Post::whereDate('published_at', $date->format('Y-m-d'))
                    ->where('status', 'published')
                    ->count();

                $data['labels'][] = $date->format('M d');
                $data['data'][] = $count;
            }

            return $data;
        });
    }

    /**
     * Get traffic chart data (last 7 days)
     */
    public function getTrafficChart(): array
    {
        return Cache::remember('analytics:traffic:7days', 300, function () {
            $data = [
                'labels' => [],
                'views' => [],
                'unique_visitors' => [],
            ];

            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $dateStr = $date->format('Y-m-d');

                $data['labels'][] = $date->format('M d');
                $data['views'][] = $this->getViewsCount($dateStr);
                $data['unique_visitors'][] = $this->getUniqueVisitorsCount($dateStr);
            }

            return $data;
        });
    }

    /**
     * Get category distribution
     */
    public function getCategoryDistribution(): array
    {
        return Cache::remember('analytics:categories:distribution', 600, function () {
            $categories = DB::table('posts')
                ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->where('posts.status', 'published')
                ->select('categories.name', DB::raw('COUNT(*) as count'))
                ->groupBy('categories.name')
                ->orderBy('count', 'desc')
                ->limit(10)
                ->get();

            return [
                'labels' => $categories->pluck('name')->toArray(),
                'data' => $categories->pluck('count')->toArray(),
            ];
        });
    }

    /**
     * Export analytics report
     */
    public function exportReport(string $format = 'json'): string
    {
        $data = $this->getDashboardSummary();

        if ($format === 'csv') {
            return $this->exportToCsv($data);
        }

        return json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     * Export data to CSV
     */
    protected function exportToCsv(array $data): string
    {
        $csv = "Analytics Report - " . now()->format('Y-m-d H:i:s') . "\n\n";

        // Posts summary
        $csv .= "POSTS ANALYTICS\n";
        $csv .= "Total Posts," . $data['posts']['total'] . "\n";
        $csv .= "Published," . $data['posts']['published'] . "\n";
        $csv .= "Draft," . $data['posts']['draft'] . "\n";
        $csv .= "Total Views," . $data['posts']['total_views'] . "\n\n";

        // Popular posts
        $csv .= "POPULAR POSTS\n";
        $csv .= "Title,Views\n";
        foreach ($data['popular_posts'] as $post) {
            $csv .= '"' . $post['title'] . '",' . $post['views'] . "\n";
        }

        return $csv;
    }
}
