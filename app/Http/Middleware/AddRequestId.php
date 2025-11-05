<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AddRequestId
{
    /**
     * Handle an incoming request.
     *
     * Add a unique request ID to each request for tracking and debugging.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Generate or use existing request ID from header
        $requestId = $request->header('X-Request-ID') ?? (string) Str::uuid();

        // Store in request attributes
        $request->attributes->set('request_id', $requestId);

        // Add to log context for all subsequent logs in this request
        Log::withContext([
            'request_id' => $requestId,
            'method' => $request->method(),
            'path' => $request->path(),
            'ip' => $request->ip(),
        ]);

        $response = $next($request);

        // Add request ID to response headers
        if ($response instanceof Response) {
            $response->headers->set('X-Request-ID', $requestId);
        }

        return $response;
    }
}
