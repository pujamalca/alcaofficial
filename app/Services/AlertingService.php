<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AlertingService
{
    /**
     * Send alert to configured channels
     */
    public function sendAlert(string $level, string $title, string $message, array $context = []): void
    {
        // Log the alert
        Log::channel('alerts')->{$level}($title, array_merge(['message' => $message], $context));

        // Send to Slack if configured
        if (config('services.slack.webhook_url')) {
            $this->sendSlackAlert($level, $title, $message, $context);
        }

        // Send to Discord if configured
        if (config('services.discord.webhook_url')) {
            $this->sendDiscordAlert($level, $title, $message, $context);
        }

        // Send to email if critical
        if ($level === 'critical' && config('services.alert_email')) {
            $this->sendEmailAlert($title, $message, $context);
        }
    }

    /**
     * Send alert to Slack
     */
    protected function sendSlackAlert(string $level, string $title, string $message, array $context): void
    {
        $color = match ($level) {
            'critical', 'emergency' => 'danger',
            'error' => 'warning',
            'warning' => 'warning',
            default => 'good',
        };

        $emoji = match ($level) {
            'critical', 'emergency' => ':rotating_light:',
            'error' => ':x:',
            'warning' => ':warning:',
            default => ':information_source:',
        };

        try {
            Http::post(config('services.slack.webhook_url'), [
                'text' => "{$emoji} *{$title}*",
                'attachments' => [
                    [
                        'color' => $color,
                        'text' => $message,
                        'fields' => array_map(fn ($key, $value) => [
                            'title' => ucfirst($key),
                            'value' => is_scalar($value) ? $value : json_encode($value),
                            'short' => true,
                        ], array_keys($context), $context),
                        'footer' => config('app.name'),
                        'ts' => time(),
                    ],
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send Slack alert', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Send alert to Discord
     */
    protected function sendDiscordAlert(string $level, string $title, string $message, array $context): void
    {
        $color = match ($level) {
            'critical', 'emergency' => 0xFF0000, // Red
            'error' => 0xFF6600, // Orange
            'warning' => 0xFFCC00, // Yellow
            default => 0x0099FF, // Blue
        };

        try {
            Http::post(config('services.discord.webhook_url'), [
                'embeds' => [
                    [
                        'title' => $title,
                        'description' => $message,
                        'color' => $color,
                        'fields' => array_map(fn ($key, $value) => [
                            'name' => ucfirst($key),
                            'value' => is_scalar($value) ? $value : json_encode($value),
                            'inline' => true,
                        ], array_keys($context), $context),
                        'footer' => [
                            'text' => config('app.name'),
                        ],
                        'timestamp' => now()->toIso8601String(),
                    ],
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send Discord alert', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Send email alert
     */
    protected function sendEmailAlert(string $title, string $message, array $context): void
    {
        // Implement email sending logic
        // This can be done via Mail facade or queued notification
        Log::info('Email alert would be sent', compact('title', 'message', 'context'));
    }

    /**
     * Alert for high error rate
     */
    public function alertHighErrorRate(int $errorCount, int $timeWindow): void
    {
        $this->sendAlert(
            'critical',
            'High Error Rate Detected',
            "Detected {$errorCount} errors in the last {$timeWindow} minutes",
            [
                'error_count' => $errorCount,
                'time_window' => "{$timeWindow} minutes",
                'threshold' => config('monitoring.error_threshold', 100),
            ]
        );
    }

    /**
     * Alert for slow response time
     */
    public function alertSlowResponse(float $avgResponseTime, string $endpoint): void
    {
        $this->sendAlert(
            'warning',
            'Slow Response Time',
            "Average response time for {$endpoint} is {$avgResponseTime}ms",
            [
                'endpoint' => $endpoint,
                'avg_response_time' => round($avgResponseTime, 2) . 'ms',
                'threshold' => config('monitoring.response_time_threshold', 1000) . 'ms',
            ]
        );
    }

    /**
     * Alert for high queue size
     */
    public function alertHighQueueSize(int $queueSize): void
    {
        $this->sendAlert(
            'warning',
            'High Queue Size',
            "Queue has grown to {$queueSize} jobs",
            [
                'queue_size' => $queueSize,
                'threshold' => config('monitoring.queue_size_threshold', 1000),
            ]
        );
    }

    /**
     * Alert for database connection issues
     */
    public function alertDatabaseIssue(string $error): void
    {
        $this->sendAlert(
            'critical',
            'Database Connection Issue',
            $error,
            [
                'database' => config('database.default'),
                'host' => config('database.connections.' . config('database.default') . '.host'),
            ]
        );
    }
}
