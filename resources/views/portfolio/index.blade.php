@extends('layouts.app')

@section('title', 'Portfolio - ' . config('app.name'))
@section('meta_description', 'Lihat portfolio proyek-proyek yang telah kami kerjakan. Website, aplikasi web, dan sistem informasi berkualitas tinggi.')

@push('meta')
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('portfolio.index') }}">
    <meta property="og:title" content="Portfolio - {{ config('app.name') }}">
    <meta property="og:description" content="Lihat portfolio proyek-proyek yang telah kami kerjakan. Website, aplikasi web, dan sistem informasi berkualitas tinggi.">
    <meta property="og:image" content="{{ asset('alca.webp') }}">

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ route('portfolio.index') }}">
    <meta property="twitter:title" content="Portfolio - {{ config('app.name') }}">
    <meta property="twitter:description" content="Lihat portfolio proyek-proyek yang telah kami kerjakan.">
    <meta property="twitter:image" content="{{ asset('alca.webp') }}">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ route('portfolio.index') }}">
@endpush

@push('scripts')
    @php
        $structuredItems = $portfolioItems->map(function ($item, $index) {
            $data = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'item' => array_filter([
                    '@type' => 'CreativeWork',
                    '@id' => route('portfolio.show', $item->slug),
                    'name' => $item->title,
                    'description' => $item->description,
                    'image' => $item->header_image ? \Illuminate\Support\Facades\Storage::url($item->header_image) : null,
                    'url' => $item->url,
                    'genre' => $item->category ? ucfirst($item->category) : null,
                    'aggregateRating' => $item->rating ? [
                        '@type' => 'AggregateRating',
                        'ratingValue' => $item->rating,
                        'bestRating' => '5',
                        'ratingCount' => $item->rating_count ?? 1,
                    ] : null,
                    'author' => [
                        '@type' => 'Organization',
                        'name' => config('app.name'),
                    ],
                ], fn ($value) => !is_null($value)),
            ];

            return $data;
        })->toArray();

        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => 'Portfolio',
            'description' => 'Portfolio proyek-proyek yang telah kami kerjakan',
            'url' => route('portfolio.index'),
            'about' => [
                '@type' => 'Organization',
                'name' => config('app.name'),
                'url' => url('/'),
            ],
            'mainEntity' => [
                '@type' => 'ItemList',
                'numberOfItems' => $portfolioItems->total(),
                'itemListElement' => $structuredItems,
            ],
        ];
    @endphp

    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
        {!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
    {{-- Page Header --}}
    <section class="section section-gradient section-overlay text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <span class="badge mb-4">
                    <i class="fas fa-layer-group mr-2"></i> Portfolio
                </span>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Portfolio Kami</h1>
                <p class="text-xl text-white/85">
                    Karya terbaik kami dalam pengembangan web dan aplikasi
                </p>
            </div>
        </div>
    </section>

    {{-- Filter Section --}}
    <section class="section section-gradient section-overlay py-8">
        <div class="container mx-auto px-4">
            <div class="content-panel px-6 py-6 sm:px-10 sm:py-8">
                <form action="{{ route('portfolio.index') }}" method="GET" class="flex flex-col gap-4 md:flex-row md:items-center">
                    {{-- Category Filter --}}
                    <div class="select-wrapper flex-1 w-full md:w-auto">
                        <select
                            name="category"
                            class="custom-select w-full px-4 py-3 border border-gray-200 dark:border-slate-700 rounded-xl bg-white dark:bg-slate-900 text-gray-700 dark:text-gray-100"
                        >
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                                    {{ ucfirst($category) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-3 w-full md:w-auto justify-end md:justify-start">
                        <button
                            type="submit"
                            class="btn-primary flex items-center justify-center gap-2 w-full md:w-auto"
                        >
                            <i class="fas fa-filter"></i>
                            Terapkan
                        </button>

                        @if(request('category'))
                            <a
                                href="{{ route('portfolio.index') }}"
                                class="btn-outline flex items-center justify-center gap-2 w-full md:w-auto"
                            >
                                <i class="fas fa-undo-alt"></i>
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Portfolio Grid --}}
    <section class="section section-muted py-16">
        <div class="container mx-auto px-4">
            @if($portfolioItems->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($portfolioItems as $item)
                        @php
                            $imageUrl = null;
                            if ($item->header_image) {
                                $imageUrl = \Illuminate\Support\Str::startsWith($item->header_image, ['http://', 'https://'])
                                    ? $item->header_image
                                    : \Illuminate\Support\Facades\Storage::url($item->header_image);
                            } elseif (! empty($item->images)) {
                                $primaryImage = is_array($item->images) ? ($item->images[0] ?? null) : null;
                                if ($primaryImage) {
                                    $imageUrl = \Illuminate\Support\Str::startsWith($primaryImage, ['http://', 'https://'])
                                        ? $primaryImage
                                        : \Illuminate\Support\Facades\Storage::url($primaryImage);
                                }
                            }
                        @endphp
                        <div class="portfolio-card surface-card overflow-hidden transition-all duration-300 group">
                            {{-- Portfolio Image --}}
                            <div class="relative overflow-hidden aspect-video bg-slate-200 dark:bg-slate-800">
                                @if($imageUrl)
                                    <img src="{{ $imageUrl }}"
                                         alt="{{ $item->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-600 to-sky-500">
                                        <svg class="w-20 h-20 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif

                                {{-- Category Badge --}}
                                @if($item->category)
                                    <div class="absolute top-4 left-4">
                                        <span class="px-3 py-1 bg-white/90 dark:bg-slate-900/80 text-blue-700 dark:text-blue-300 text-sm font-semibold rounded-full shadow-sm">
                                            {{ ucfirst($item->category) }}
                                        </span>
                                    </div>
                                @endif

                                {{-- Rating Badge --}}
                                @if($item->rating)
                                    <div class="absolute top-4 right-4">
                                        <span class="rating-badge">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span>{{ number_format($item->rating, 1) }}</span>
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Portfolio Content --}}
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                    {{ $item->title }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-200 mb-6 leading-relaxed line-clamp-2">
                                    {{ $item->description }}
                                </p>

                                {{-- View Detail Button --}}
                                <a href="{{ route('portfolio.show', $item->slug) }}"
                                   class="card-primary-btn gap-2">
                                    Lihat Detail
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="flex justify-center">
                    {{ $portfolioItems->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-16">
                    <svg class="mx-auto h-24 w-24 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Belum ada portfolio</h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">Portfolio akan segera ditampilkan.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section gradient-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white dark:bg-blue-500 rounded-full blur-3xl animate-pulse opacity-20"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white dark:bg-cyan-500 rounded-full blur-3xl animate-pulse opacity-20" style="animation-delay: 1s;"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white relative z-10">
            <div class="animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-black mb-6">Ingin Proyek Anda Jadi Berikutnya?</h2>
                <p class="text-xl text-white leading-relaxed mb-10">Mari wujudkan ide Anda bersama tim profesional kami.</p>
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="https://wa.me/6288101018577?text=Halo%20AlcaOfficial,%20saya%20ingin%20konsultasi%20tentang%20pembuatan%20website"
                       target="_blank"
                       class="px-10 py-5 bg-green-500 text-white rounded-full font-black text-lg hover:shadow-2xl hover:bg-green-600 transition transform hover:scale-105 shadow-xl">
                        <i class="fab fa-whatsapp mr-2 text-2xl"></i> WhatsApp Kami
                    </a>
                    <a href="#kontak"
                       class="px-10 py-5 border-4 border-white text-white rounded-full font-black text-lg hover:bg-white hover:text-blue-600 transition transform hover:scale-105 shadow-lg">
                        <i class="fas fa-envelope mr-2"></i> Email Kami
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
