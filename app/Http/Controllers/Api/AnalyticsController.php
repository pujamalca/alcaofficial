<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function __construct(
        protected readonly AnalyticsService $analyticsService
    ) {
    }

    /**
     * Get dashboard summary
     */
    public function dashboard(): JsonResponse
    {
        $summary = $this->analyticsService->getDashboardSummary();

        return response()->json([
            'success' => true,
            'data' => $summary,
        ]);
    }

    /**
     * Get posts growth chart
     */
    public function postsGrowth(): JsonResponse
    {
        $chartData = $this->analyticsService->getPostsGrowthChart();

        return response()->json([
            'success' => true,
            'data' => $chartData,
        ]);
    }

    /**
     * Get traffic chart
     */
    public function traffic(): JsonResponse
    {
        $chartData = $this->analyticsService->getTrafficChart();

        return response()->json([
            'success' => true,
            'data' => $chartData,
        ]);
    }

    /**
     * Get category distribution
     */
    public function categories(): JsonResponse
    {
        $chartData = $this->analyticsService->getCategoryDistribution();

        return response()->json([
            'success' => true,
            'data' => $chartData,
        ]);
    }

    /**
     * Export analytics report
     */
    public function export(Request $request): mixed
    {
        $validated = $request->validate([
            'format' => 'sometimes|in:json,csv',
        ]);

        $format = $validated['format'] ?? 'json';
        $report = $this->analyticsService->exportReport($format);

        if ($format === 'csv') {
            return response($report, 200)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="analytics-report-' . now()->format('Y-m-d') . '.csv"');
        }

        return response($report, 200)
            ->header('Content-Type', 'application/json')
            ->header('Content-Disposition', 'attachment; filename="analytics-report-' . now()->format('Y-m-d') . '.json"');
    }
}
