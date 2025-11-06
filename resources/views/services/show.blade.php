@extends('layouts.app')

@section('title', $service->title . ' - Layanan ' . config('app.name'))
@section('meta_description', $service->description)

@push('meta')
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('services.show', $service->slug) }}">
    <meta property="og:title" content="{{ $service->title }} - {{ config('app.name') }}">
    <meta property="og:description" content="{{ $service->description }}">
    <meta property="og:image" content="{{ asset('alca.webp') }}">

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ route('services.show', $service->slug) }}">
    <meta property="twitter:title" content="{{ $service->title }} - {{ config('app.name') }}">
    <meta property="twitter:description" content="{{ $service->description }}">
    <meta property="twitter:image" content="{{ asset('alca.webp') }}">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ route('services.show', $service->slug) }}">
@endpush

@push('scripts')
    {{-- JSON-LD Structured Data for Service --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "@id": "{{ route('services.show', $service->slug) }}",
        "name": "{{ $service->title }}",
        "description": "{{ $service->description }}",
        "url": "{{ route('services.show', $service->slug) }}",
        "provider": {
            "@type": "Organization",
            "name": "{{ config('app.name') }}",
            "url": "{{ url('/') }}",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+62-881-0101-8577",
                "contactType": "Customer Service",
                "availableLanguage": ["Indonesian", "English"]
            }
        },
        "serviceType": "{{ $service->title }}",
        @if($service->features && count($service->features) > 0)
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Fitur Layanan",
            "itemListElement": [
                @foreach($service->features as $index => $feature)
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "{{ is_string($feature) ? $feature : (is_array($feature) ? ($feature['name'] ?? 'Feature') : 'Feature') }}"
                    }
                }{{ !$loop->last ? ',' : '' }}
                @endforeach
            ]
        },
        @endif
        "areaServed": {
            "@type": "Country",
            "name": "Indonesia"
        }
    }
    </script>

    {{-- Breadcrumb Structured Data --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{ url('/') }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Layanan",
                "item": "{{ route('services.index') }}"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $service->title }}",
                "item": "{{ route('services.show', $service->slug) }}"
            }
        ]
    }
    </script>
@endpush

@section('content')
    {{-- Service Header --}}
    <article class="bg-white">
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto">
                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-2 text-sm text-gray-600 mb-8">
                    <a href="/" class="hover:text-blue-600">Home</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('services.index') }}" class="hover:text-blue-600">Layanan</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-gray-900">{{ $service->title }}</span>
                </nav>

                {{-- Service Icon & Title --}}
                <div class="text-center mb-12">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mb-6">
                        <i class="{{ $service->icon }} text-5xl text-white"></i>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        {{ $service->title }}
                    </h1>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        {{ $service->description }}
                    </p>
                </div>

                {{-- Service Content --}}
                @if($service->content)
                    <div class="prose prose-lg max-w-none mb-12">
                        {!! nl2br(e($service->content)) !!}
                    </div>
                @endif

                {{-- Features Section --}}
                @if($service->features && count($service->features) > 0)
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Fitur & Layanan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($service->features as $feature)
                                <div class="flex items-start bg-gray-50 rounded-lg p-4">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-gray-700">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Benefits Section --}}
                @if($service->benefits && count($service->benefits) > 0)
                    <div class="mb-12 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Manfaat untuk Bisnis Anda</h2>
                        <div class="space-y-4">
                            @foreach($service->benefits as $benefit)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-gray-700 text-lg">{{ $benefit }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- CTA Section --}}
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 text-center text-white mb-12">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4">
                        Tertarik dengan Layanan Ini?
                    </h3>
                    <p class="text-blue-100 text-lg mb-6">
                        Konsultasikan kebutuhan proyek Anda dengan tim kami sekarang
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ url('/#contact') }}"
                           class="inline-flex items-center justify-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Hubungi Kami
                        </a>
                        <a href="https://wa.me/6288101018577?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20{{ urlencode($service->title) }}"
                           class="inline-flex items-center justify-center px-8 py-4 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition-colors">
                            <i class="fab fa-whatsapp text-xl mr-2"></i>
                            Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </article>

    {{-- Other Services Section --}}
    @if($otherServices->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Layanan Lainnya</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($otherServices as $otherService)
                            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full">
                                        <i class="{{ $otherService->icon }} text-3xl text-blue-600"></i>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                                        {{ $otherService->title }}
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ $otherService->description }}
                                    </p>
                                    <a href="{{ route('services.show', $otherService->slug) }}"
                                       class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                                        Lihat Detail
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
