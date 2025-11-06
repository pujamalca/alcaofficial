@extends('layouts.app')

@section('title', $portfolioItem->title . ' - Portfolio ' . config('app.name'))
@section('meta_description', $portfolioItem->description)

@push('meta')
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ route('portfolio.show', $portfolioItem->slug) }}">
    <meta property="og:title" content="{{ $portfolioItem->title }} - {{ config('app.name') }}">
    <meta property="og:description" content="{{ $portfolioItem->description }}">
    @if($portfolioItem->header_image)
    <meta property="og:image" content="{{ Storage::url($portfolioItem->header_image) }}">
    @else
    <meta property="og:image" content="{{ asset('alca.webp') }}">
    @endif
    @if($portfolioItem->project_date)
    <meta property="article:published_time" content="{{ $portfolioItem->project_date->toIso8601String() }}">
    @endif

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ route('portfolio.show', $portfolioItem->slug) }}">
    <meta property="twitter:title" content="{{ $portfolioItem->title }} - {{ config('app.name') }}">
    <meta property="twitter:description" content="{{ $portfolioItem->description }}">
    @if($portfolioItem->header_image)
    <meta property="twitter:image" content="{{ Storage::url($portfolioItem->header_image) }}">
    @else
    <meta property="twitter:image" content="{{ asset('alca.webp') }}">
    @endif

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ route('portfolio.show', $portfolioItem->slug) }}">
@endpush

@push('scripts')
    {{-- JSON-LD Structured Data for Creative Work --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CreativeWork",
        "@id": "{{ route('portfolio.show', $portfolioItem->slug) }}",
        "name": "{{ $portfolioItem->title }}",
        "description": "{{ $portfolioItem->description }}",
        "url": "{{ route('portfolio.show', $portfolioItem->slug) }}",
        @if($portfolioItem->header_image)
        "image": {
            "@type": "ImageObject",
            "url": "{{ Storage::url($portfolioItem->header_image) }}",
            "width": "1200",
            "height": "630"
        },
        @endif
        @if($portfolioItem->category)
        "genre": "{{ ucfirst($portfolioItem->category) }}",
        @endif
        @if($portfolioItem->project_date)
        "datePublished": "{{ $portfolioItem->project_date->toIso8601String() }}",
        @endif
        @if($portfolioItem->url)
        "mainEntityOfPage": "{{ $portfolioItem->url }}",
        @endif
        @if($portfolioItem->client_name)
        "client": {
            "@type": "Organization",
            "name": "{{ $portfolioItem->client_name }}"
        },
        @endif
        "creator": {
            "@type": "Organization",
            "name": "{{ config('app.name') }}",
            "url": "{{ url('/') }}"
        },
        "author": {
            "@type": "Organization",
            "name": "{{ config('app.name') }}",
            "url": "{{ url('/') }}"
        },
        @if($portfolioItem->rating)
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "{{ $portfolioItem->rating }}",
            "bestRating": "5",
            "worstRating": "1",
            "ratingCount": "1"
        },
        @endif
        @if($portfolioItem->technologies && count($portfolioItem->technologies) > 0)
        "keywords": "{{ implode(', ', $portfolioItem->technologies) }}",
        @endif
        "inLanguage": "id-ID"
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
                "name": "Portfolio",
                "item": "{{ route('portfolio.index') }}"
            },
            @if($portfolioItem->category)
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ ucfirst($portfolioItem->category) }}",
                "item": "{{ route('portfolio.index', ['category' => $portfolioItem->category]) }}"
            },
            {
                "@type": "ListItem",
                "position": 4,
                "name": "{{ $portfolioItem->title }}",
                "item": "{{ route('portfolio.show', $portfolioItem->slug) }}"
            }
            @else
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $portfolioItem->title }}",
                "item": "{{ route('portfolio.show', $portfolioItem->slug) }}"
            }
            @endif
        ]
    }
    </script>
@endpush

@section('content')
    {{-- Portfolio Header --}}
    <article class="bg-white">
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-5xl mx-auto">
                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-2 text-sm text-gray-600 mb-8">
                    <a href="/" class="hover:text-purple-600">Home</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('portfolio.index') }}" class="hover:text-purple-600">Portfolio</a>
                    @if($portfolioItem->category)
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <a href="{{ route('portfolio.index', ['category' => $portfolioItem->category]) }}" class="hover:text-purple-600">
                            {{ ucfirst($portfolioItem->category) }}
                        </a>
                    @endif
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-gray-900">{{ $portfolioItem->title }}</span>
                </nav>

                {{-- Category Badge & Rating --}}
                <div class="flex items-center gap-4 mb-6">
                    @if($portfolioItem->category)
                        <span class="px-4 py-2 bg-purple-100 text-purple-700 text-sm font-semibold rounded-full">
                            {{ ucfirst($portfolioItem->category) }}
                        </span>
                    @endif
                    @if($portfolioItem->rating)
                        <div class="flex items-center gap-2">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $portfolioItem->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                            <span class="text-gray-700 font-semibold">{{ $portfolioItem->rating }}</span>
                        </div>
                    @endif
                </div>

                {{-- Title --}}
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    {{ $portfolioItem->title }}
                </h1>

                {{-- Meta Info --}}
                <div class="flex flex-wrap items-center gap-6 pb-8 border-b border-gray-200 mb-8">
                    @if($portfolioItem->client_name)
                        <div class="flex items-center gap-2 text-gray-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="font-medium">{{ $portfolioItem->client_name }}</span>
                        </div>
                    @endif

                    @if($portfolioItem->project_date)
                        <div class="flex items-center gap-2 text-gray-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $portfolioItem->project_date->translatedFormat('F Y') }}</span>
                        </div>
                    @endif

                    @if($portfolioItem->url)
                        <a href="{{ $portfolioItem->url }}" target="_blank" rel="noopener" class="flex items-center gap-2 text-purple-600 hover:text-purple-700 font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            <span>Kunjungi Website</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Header Image --}}
        @if($portfolioItem->header_image)
            <div class="w-full bg-gray-100 mb-12">
                <div class="container mx-auto px-4">
                    <div class="max-w-5xl mx-auto">
                        <img src="{{ Storage::url($portfolioItem->header_image) }}"
                             alt="{{ $portfolioItem->title }}"
                             class="w-full rounded-2xl shadow-2xl">
                    </div>
                </div>
            </div>
        @endif

        {{-- Content Section --}}
        <div class="container mx-auto px-4 pb-12">
            <div class="max-w-5xl mx-auto">
                {{-- Description --}}
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Tentang Proyek</h2>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        {{ $portfolioItem->description }}
                    </p>
                </div>

                {{-- Detailed Content --}}
                @if($portfolioItem->content)
                    <div class="prose prose-lg max-w-none mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Detail Proyek</h2>
                        {!! nl2br(e($portfolioItem->content)) !!}
                    </div>
                @endif

                {{-- Technologies Used --}}
                @if($portfolioItem->technologies && count($portfolioItem->technologies) > 0)
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Teknologi yang Digunakan</h2>
                        <div class="flex flex-wrap gap-3">
                            @foreach($portfolioItem->technologies as $tech)
                                <span class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-medium rounded-lg">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Additional Images Gallery --}}
                @if($portfolioItem->images && count($portfolioItem->images) > 0)
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Galeri</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($portfolioItem->images as $image)
                                <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden">
                                    <img src="{{ Storage::url($image) }}"
                                         alt="Gallery image"
                                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-300 cursor-pointer">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- CTA Section --}}
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl p-8 text-center text-white">
                    <h3 class="text-2xl md:text-3xl font-bold mb-4">
                        Tertarik dengan Hasil Kerja Kami?
                    </h3>
                    <p class="text-purple-100 text-lg mb-6">
                        Mari diskusikan proyek Anda dan wujudkan bersama
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ url('/#contact') }}"
                           class="inline-flex items-center justify-center px-8 py-4 bg-white text-purple-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Hubungi Kami
                        </a>
                        <a href="https://wa.me/6288101018577?text=Halo%2C%20saya%20tertarik%20dengan%20portfolio%20{{ urlencode($portfolioItem->title) }}"
                           class="inline-flex items-center justify-center px-8 py-4 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition-colors">
                            <i class="fab fa-whatsapp text-xl mr-2"></i>
                            Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </article>

    {{-- Related Portfolio Section --}}
    @if($relatedItems->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Portfolio Terkait</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedItems as $item)
                            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                <div class="relative aspect-video bg-gray-200">
                                    @if($item->header_image)
                                        <img src="{{ Storage::url($item->header_image) }}"
                                             alt="{{ $item->title }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-500 to-pink-600">
                                            <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                                        {{ $item->title }}
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ $item->description }}
                                    </p>
                                    <a href="{{ route('portfolio.show', $item->slug) }}"
                                       class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium">
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
