@props([
    'type' => 'info',
    'dismissible' => false,
    'title' => null,
    'icon' => true,
])

@php
    // Type configurations with colors and icons
    $typeConfig = [
        'success' => [
            'containerClass' => 'bg-green-50 border-green-200 text-green-800',
            'iconClass' => 'text-green-600',
            'titleClass' => 'text-green-900',
            'buttonClass' => 'text-green-600 hover:bg-green-100 focus:ring-green-500',
            'icon' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>',
            'ariaLabel' => 'Success alert',
        ],
        'error' => [
            'containerClass' => 'bg-red-50 border-red-200 text-red-800',
            'iconClass' => 'text-red-600',
            'titleClass' => 'text-red-900',
            'buttonClass' => 'text-red-600 hover:bg-red-100 focus:ring-red-500',
            'icon' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>',
            'ariaLabel' => 'Error alert',
        ],
        'warning' => [
            'containerClass' => 'bg-yellow-50 border-yellow-200 text-yellow-800',
            'iconClass' => 'text-yellow-600',
            'titleClass' => 'text-yellow-900',
            'buttonClass' => 'text-yellow-600 hover:bg-yellow-100 focus:ring-yellow-500',
            'icon' => '<path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>',
            'ariaLabel' => 'Warning alert',
        ],
        'info' => [
            'containerClass' => 'bg-blue-50 border-blue-200 text-blue-800',
            'iconClass' => 'text-blue-600',
            'titleClass' => 'text-blue-900',
            'buttonClass' => 'text-blue-600 hover:bg-blue-100 focus:ring-blue-500',
            'icon' => '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>',
            'ariaLabel' => 'Information alert',
        ],
    ];

    $config = $typeConfig[$type] ?? $typeConfig['info'];
@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-95"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-95"
    role="alert"
    aria-live="polite"
    aria-label="{{ $config['ariaLabel'] }}"
    {{ $attributes->merge(['class' => 'rounded-lg border p-4 ' . $config['containerClass']]) }}
>
    <div class="flex items-start gap-3">
        @if($icon)
            {{-- Icon --}}
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 {{ $config['iconClass'] }}" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    {!! $config['icon'] !!}
                </svg>
            </div>
        @endif

        {{-- Content --}}
        <div class="flex-1 min-w-0">
            @if($title)
                <h3 class="text-sm font-semibold {{ $config['titleClass'] }} mb-1">
                    {{ $title }}
                </h3>
            @endif

            <div class="text-sm {{ $title ? 'mt-1' : '' }}">
                {{ $slot }}
            </div>
        </div>

        @if($dismissible)
            {{-- Dismiss button --}}
            <button
                type="button"
                @click="show = false"
                class="flex-shrink-0 inline-flex items-center justify-center w-8 h-8 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $config['buttonClass'] }}"
                aria-label="Dismiss alert"
            >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        @endif
    </div>
</div>
