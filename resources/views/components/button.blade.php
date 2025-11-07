@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
    'icon' => null,
    'iconPosition' => 'left',
    'loading' => false,
    'disabled' => false,
])

@php
    // Base classes for all buttons
    $baseClasses = 'inline-flex items-center justify-center font-semibold rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

    // Variant classes
    $variantClasses = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm hover:shadow-md active:bg-blue-800',
        'secondary' => 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500 shadow-sm hover:shadow-md active:bg-gray-800',
        'outline' => 'bg-white text-gray-700 border-2 border-gray-300 hover:bg-gray-50 focus:ring-gray-500 hover:border-gray-400 active:bg-gray-100',
        'ghost' => 'bg-transparent text-gray-700 hover:bg-gray-100 focus:ring-gray-500 active:bg-gray-200',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500 shadow-sm hover:shadow-md active:bg-red-800',
        'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500 shadow-sm hover:shadow-md active:bg-green-800',
    ];

    // Size classes
    $sizeClasses = [
        'xs' => 'px-2.5 py-1.5 text-xs gap-1',
        'sm' => 'px-3 py-2 text-sm gap-1.5 min-h-[38px]',
        'md' => 'px-4 py-2.5 text-base gap-2 min-h-[44px]',
        'lg' => 'px-6 py-3 text-lg gap-2.5 min-h-[48px]',
        'xl' => 'px-8 py-4 text-xl gap-3 min-h-[56px]',
    ];

    // Icon size classes
    $iconSizeClasses = [
        'xs' => 'w-3 h-3',
        'sm' => 'w-4 h-4',
        'md' => 'w-5 h-5',
        'lg' => 'w-6 h-6',
        'xl' => 'w-7 h-7',
    ];

    // Combine classes
    $classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']) . ' ' . ($sizeClasses[$size] ?? $sizeClasses['md']);

    // Icon size
    $iconSize = $iconSizeClasses[$size] ?? $iconSizeClasses['md'];

    // Check if disabled or loading
    $isDisabled = $disabled || $loading;
@endphp

@if($href && !$isDisabled)
    {{-- Render as anchor tag --}}
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon && $iconPosition === 'left')
            <span class="{{ $iconSize }} flex-shrink-0" aria-hidden="true">
                {!! $icon !!}
            </span>
        @endif

        @if($loading)
            <svg class="{{ $iconSize }} animate-spin flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @endif

        <span>{{ $slot }}</span>

        @if($icon && $iconPosition === 'right')
            <span class="{{ $iconSize }} flex-shrink-0" aria-hidden="true">
                {!! $icon !!}
            </span>
        @endif
    </a>
@else
    {{-- Render as button tag --}}
    <button
        type="{{ $type }}"
        @if($isDisabled) disabled @endif
        {{ $attributes->merge(['class' => $classes]) }}
    >
        @if($icon && $iconPosition === 'left' && !$loading)
            <span class="{{ $iconSize }} flex-shrink-0" aria-hidden="true">
                {!! $icon !!}
            </span>
        @endif

        @if($loading)
            <svg class="{{ $iconSize }} animate-spin flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="sr-only">Loading...</span>
        @endif

        <span>{{ $slot }}</span>

        @if($icon && $iconPosition === 'right' && !$loading)
            <span class="{{ $iconSize }} flex-shrink-0" aria-hidden="true">
                {!! $icon !!}
            </span>
        @endif
    </button>
@endif
