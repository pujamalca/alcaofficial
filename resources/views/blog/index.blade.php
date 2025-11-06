@extends('layouts.app')

@section('title', 'Blog - ' . config('app.name'))
@section('meta_description', 'Baca artikel dan tutorial terbaru tentang Laravel, Filament, API development, dan topik pengembangan web lainnya.')

@section('content')
    {{-- Hero Section --}}
    <section class="section section-gradient section-overlay text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <span class="badge mb-4">
                    <i class="fas fa-pen-nib mr-2"></i> Blog & Artikel
                </span>
                <h1 class="section-title text-white">Blog & Artikel</h1>
                <p class="section-subtitle text-white/85">
                    Temukan tutorial, insight bisnis, dan cerita pengembangan produk digital langsung dari tim AlcaOfficial.
                </p>
            </div>
        </div>
    </section>

    {{-- Search & Filter --}}
    <section class="section section-gradient section-overlay py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="content-panel px-6 py-6 sm:px-10 sm:py-8">
                <form action="{{ route('blog.index') }}" method="GET" class="flex flex-col gap-4 lg:flex-row lg:items-center">
                    {{-- Search Input --}}
                    <div class="relative flex-1 w-full">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m1-4a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari artikel, topik, atau kata kunci..."
                            class="form-input with-leading-icon border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-gray-700 dark:text-gray-100 placeholder-gray-400 dark:placeholder-slate-400"
                        >
                    </div>

                    {{-- Category Filter --}}
                    <div class="select-wrapper w-full lg:w-64">
                        <select
                            name="category"
                            class="custom-select w-full px-4 py-3 border border-gray-200 dark:border-slate-700 rounded-xl bg-white dark:bg-slate-900 text-gray-700 dark:text-gray-100"
                            onchange="this.form.submit()"
                        >
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }} ({{ $category->posts_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                        <button
                            type="submit"
                            class="btn-primary flex items-center justify-center gap-2 w-full sm:w-auto"
                        >
                            <i class="fas fa-search"></i>
                            <span>Cari</span>
                        </button>

                        @if(request()->hasAny(['search', 'category', 'tag']))
                            <a
                                href="{{ route('blog.index') }}"
                                class="btn-outline flex items-center justify-center gap-2 w-full sm:w-auto"
                            >
                                <i class="fas fa-undo-alt"></i>
                                <span>Reset</span>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Blog Posts --}}
    <section class="section section-muted py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <article class="group blog-card overflow-hidden flex flex-col">
                            {{-- Featured Image --}}
                            <div class="relative overflow-hidden aspect-video bg-gradient-to-br from-blue-500 to-indigo-600">
                                @if($post->featured_image)
                                    <img
                                        src="{{ $post->featured_image }}"
                                        alt="{{ $post->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 16h14M5 12h9"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/40 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <div class="p-6 sm:p-7 flex flex-col flex-1">
                                {{-- Category Badge --}}
                                @if($post->category)
                                    <a
                                        href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 mb-4 w-fit transition-colors hover:bg-blue-200 dark:hover:bg-blue-800/60"
                                    >
                                        <i class="fas fa-folder"></i>
                                        {{ $post->category->name }}
                                    </a>
                                @endif

                                {{-- Title --}}
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3 leading-tight line-clamp-2">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="transition-colors hover:text-blue-600 dark:hover:text-blue-400">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                {{-- Excerpt --}}
                                <p class="text-gray-600 dark:text-gray-200 line-clamp-3 leading-relaxed flex-1">
                                    {{ $post->excerpt ?? strip_tags($post->content) }}
                                </p>

                                {{-- Meta --}}
                                <div class="flex flex-wrap items-center justify-between gap-3 text-sm text-gray-500 dark:text-gray-400 pt-6 mt-6 border-t border-gray-100 dark:border-gray-700/60">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-semibold flex items-center justify-center shadow-lg shadow-blue-500/20">
                                            {{ substr($post->author->name, 0, 1) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-800 dark:text-gray-100">
                                                {{ $post->author->name }}
                                            </span>
                                            <span>{{ $post->published_at?->translatedFormat('d M Y') ?? $post->created_at->translatedFormat('d M Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        @if($post->reading_time)
                                            <span class="flex items-center gap-1.5">
                                                <i class="fas fa-clock"></i>
                                                {{ $post->reading_time }} menit baca
                                            </span>
                                        @endif
                                        <a href="{{ route('blog.show', $post->slug) }}" class="flex items-center gap-1 font-semibold text-blue-600 dark:text-blue-400 hover:underline">
                                            Baca
                                            <i class="fas fa-arrow-right text-sm"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-16">
                    <svg class="w-24 h-24 text-gray-300 dark:text-gray-600 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Belum Ada Artikel</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
                        @if(request()->hasAny(['search', 'category', 'tag']))
                            Tidak ada artikel yang sesuai dengan pencarian Anda. Silakan coba kata kunci atau filter lain.
                        @else
                            Konten blog sedang disiapkan. Nantikan insight terbaru dari kami segera!
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'category', 'tag']))
                        <a
                            href="{{ route('blog.index') }}"
                            class="btn-outline inline-flex items-center gap-2"
                        >
                            <i class="fas fa-sync-alt"></i>
                            Lihat Semua Artikel
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    {{-- Newsletter CTA --}}
    <section class="section gradient-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute -top-10 -left-10 w-64 h-64 bg-white/40 dark:bg-blue-400/30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-16 -right-10 w-72 h-72 bg-white/40 dark:bg-cyan-400/30 rounded-full blur-3xl animate-pulse" style="animation-delay: .6s;"></div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white relative z-10">
            <h2 class="text-4xl md:text-5xl font-black mb-6">Jangan Lewatkan Update Terbaru</h2>
            <p class="text-lg text-white/85 mb-10 leading-relaxed">
                Dapatkan pemberitahuan artikel baru, rangkuman case study, dan tips pengembangan website langsung ke email Anda.
            </p>

            <form class="flex flex-col sm:flex-row gap-4 max-w-2xl mx-auto">
                <input
                    type="email"
                    placeholder="Masukkan email Anda"
                    class="flex-1 px-6 py-4 rounded-xl bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-blue-200/80"
                    required
                >
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl font-bold bg-white text-blue-600 hover:text-blue-700 hover:bg-blue-50 transition-colors shadow-lg shadow-white/20 w-full sm:w-auto"
                >
                    <i class="fas fa-paper-plane"></i>
                    Berlangganan
                </button>
            </form>
        </div>
    </section>
@endsection
