@props([
    'size' => 'md',
    'color' => 'blue',
    'text' => null,
    'fullscreen' => false,
    'overlay' => false,
])

@php
    // Size classes for spinner
    $sizeClasses = [
        'xs' => 'w-4 h-4',
        'sm' => 'w-6 h-6',
        'md' => 'w-8 h-8',
        'lg' => 'w-12 h-12',
        'xl' => 'w-16 h-16',
    ];

    // Color classes for spinner
    $colorClasses = [
        'blue' => 'text-blue-600',
        'gray' => 'text-gray-600',
        'green' => 'text-green-600',
        'red' => 'text-red-600',
        'yellow' => 'text-yellow-600',
        'purple' => 'text-purple-600',
        'white' => 'text-white',
    ];

    // Text size classes
    $textSizeClasses = [
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg',
        'xl' => 'text-xl',
    ];

    $spinnerSize = $sizeClasses[$size] ?? $sizeClasses['md'];
    $spinnerColor = $colorClasses[$color] ?? $colorClasses['blue'];
    $textSize = $textSizeClasses[$size] ?? $textSizeClasses['md'];
@endphp

@if($fullscreen)
    {{-- Fullscreen loading spinner with backdrop --}}
    <div
        class="fixed inset-0 z-50 flex items-center justify-center bg-white/80 backdrop-blur-sm"
        role="status"
        aria-live="polite"
        aria-label="Loading"
    >
        <div class="flex flex-col items-center gap-4">
            {{-- Spinner --}}
            <svg
                class="{{ $spinnerSize }} {{ $spinnerColor }} animate-spin"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>

            @if($text)
                <p class="{{ $textSize }} text-gray-700 font-medium">{{ $text }}</p>
            @else
                <span class="sr-only">Loading...</span>
            @endif
        </div>
    </div>
@elseif($overlay)
    {{-- Overlay loading spinner (for specific sections) --}}
    <div
        class="absolute inset-0 z-10 flex items-center justify-center bg-white/60 backdrop-blur-sm rounded-lg"
        role="status"
        aria-live="polite"
        aria-label="Loading"
    >
        <div class="flex flex-col items-center gap-3">
            {{-- Spinner --}}
            <svg
                class="{{ $spinnerSize }} {{ $spinnerColor }} animate-spin"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>

            @if($text)
                <p class="{{ $textSize }} text-gray-700 font-medium">{{ $text }}</p>
            @else
                <span class="sr-only">Loading...</span>
            @endif
        </div>
    </div>
@else
    {{-- Inline loading spinner --}}
    <div
        {{ $attributes->merge(['class' => 'inline-flex items-center gap-2']) }}
        role="status"
        aria-live="polite"
        aria-label="Loading"
    >
        <svg
            class="{{ $spinnerSize }} {{ $spinnerColor }} animate-spin"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            aria-hidden="true"
        >
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>

        @if($text)
            <span class="{{ $textSize }} text-gray-700">{{ $text }}</span>
        @elseif($slot->isNotEmpty())
            <span class="{{ $textSize }} text-gray-700">{{ $slot }}</span>
        @else
            <span class="sr-only">Loading...</span>
        @endif
    </div>
@endif
