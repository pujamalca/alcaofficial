@extends('layouts.app')

@section('title', 'Source Code Premium Siap Pakai - ' . config('app.name'))
@section('meta_description', 'Koleksi source code premium untuk website & aplikasi Laravel, siap pakai dengan dokumentasi lengkap dan lisensi komersial.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/source-code.css') }}">
@endpush

@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

@section('content')
    <article class="source-index-page">
        {{-- Hero --}}
        <section class="source-hero">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid lg:grid-cols-12 gap-10 items-center">
                    <div class="lg:col-span-7">
                        <span class="source-hero-badge">
                            <i class="fas fa-code mr-2"></i> Koleksi Source Code Premium
                        </span>
                        <h1 class="source-hero-title">
                            Source Code Laravel Siap Pakai untuk Mempercepat Proyek Anda
                        </h1>
                        <p class="source-hero-subtitle">
                            Pilih source code profesional dengan fitur lengkap, dokumentasi jelas, dan lisensi penggunaan yang fleksibel. Cocok untuk freelancer, agensi, maupun pemilik bisnis yang ingin go digital lebih cepat.
                        </p>
                        <div class="source-hero-stats">
                            <div>
                                <span class="value">{{ number_format(\App\Models\SourceCode::active()->count()) }}+</span>
                                <span class="label">Produk Tersedia</span>
                            </div>
                            <div>
                                <span class="value">{{ number_format(\App\Models\SourceCodeOrder::count()) }}+</span>
                                <span class="label">Pembeli Puas</span>
                            </div>
                            <div>
                                <span class="value">Komersial</span>
                                <span class="label">Lisensi Penggunaan</span>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-5">
                        <div class="source-hero-card">
                            <h2>Semua paket termasuk</h2>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Dokumentasi & panduan instalasi lengkap</li>
                                <li><i class="fas fa-check-circle"></i> Update dan perbaikan bug gratis 3 bulan</li>
                                <li><i class="fas fa-check-circle"></i> Lisensi komersial & dukungan teknis</li>
                                <li><i class="fas fa-check-circle"></i> Struktur kode rapi mengikuti best practice</li>
                            </ul>
                            <a href="#source-products" class="source-hero-cta">
                                Jelajahi Koleksi <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Filter --}}
        <section class="source-filter-bar">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form method="GET" class="source-filter-form">
                    <div class="filter-search">
                        <i class="fas fa-search"></i>
                        <input
                            type="text"
                            name="q"
                            value="{{ $searchQuery }}"
                            placeholder="Cari source code, fitur, atau kebutuhan proyek..."
                            autocomplete="off"
                        >
                    </div>

                    <div class="filter-categories">
                        <a href="{{ route('source-codes.index') }}"
                           class="filter-chip {{ !$selectedCategory ? 'active' : '' }}">
                            Semua
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('source-codes.index', array_filter(['kategori' => $category->slug, 'q' => $searchQuery])) }}"
                               class="filter-chip {{ $selectedCategory === $category->slug ? 'active' : '' }}">
                                <span class="icon">
                                    <i class="{{ $category->icon ?: 'fas fa-folder-open' }}"></i>
                                </span>
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </form>
            </div>
        </section>

        {{-- Products --}}
        <section id="source-products" class="source-list-section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($sourceCodes->count() === 0)
                    <div class="source-empty-state">
                        <i class="fas fa-box-open"></i>
                        <h3>Belum ada source code yang sesuai filter.</h3>
                        <p>Coba gunakan kata kunci lain atau hubungi kami untuk permintaan khusus.</p>
                        <a href="#kontak" class="source-empty-cta">
                            Hubungi Kami
                        </a>
                    </div>
                @else
                    <div class="grid gap-8 lg:grid-cols-3 md:grid-cols-2">
                        @foreach($sourceCodes as $code)
                            @php
                                $thumbnail = $code->thumbnail;
                                $thumbnailUrl = $thumbnail
                                    ? (Str::startsWith($thumbnail, ['http://', 'https://'])
                                        ? $thumbnail
                                        : Storage::url($thumbnail))
                                    : null;
                                $effectivePrice = $code->effective_price ?? 0;
                                $formattedEffective = number_format((float) $effectivePrice, 0, ',', '.');
                                $hasDiscount = $code->has_discount ?? false;
                                $formattedOriginal = $hasDiscount ? number_format((float) ($code->price ?? 0), 0, ',', '.') : null;
                            @endphp

                            <article class="source-list-card">
                                <div class="card-media">
                                    @if($thumbnailUrl)
                                        <img src="{{ $thumbnailUrl }}"
                                             alt="Thumbnail {{ $code->title }}"
                                             loading="lazy">
                                    @else
                                        <div class="placeholder">
                                            <i class="fas fa-laptop-code"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="card-category">
                                        <i class="fas fa-layer-group"></i>
                                        {{ $code->category->name ?? 'Source Code' }}
                                    </div>
                                    <h3 class="card-title">
                                        <a href="{{ route('source-codes.show', $code->slug) }}">
                                            {{ $code->title }}
                                        </a>
                                    </h3>
                                    @if($code->short_description)
                                        <p class="card-description">
                                            {{ Str::limit($code->short_description, 110) }}
                                        </p>
                                    @endif

                                    <div class="card-price">
                                        <div>
                                            <span class="currency">{{ $code->currency ?? 'Rp' }}</span>
                                            <span class="amount">{{ $formattedEffective }}</span>
                                            @if($hasDiscount && $formattedOriginal)
                                                <span class="original">Rp {{ $formattedOriginal }}</span>
                                            @endif
                                        </div>
                                        @if($code->has_discount)
                                            <span class="discount-badge">Hemat {{ $code->discount_percentage }}%</span>
                                        @endif
                                    </div>

                                    @if(!empty($code->tech_stack))
                                        <div class="card-tech-stack">
                                            @foreach(array_slice($code->tech_stack, 0, 4) as $stack)
                                                <span class="tech-chip">{{ $stack }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('source-codes.show', $code->slug) }}" class="card-btn">
                                        Lihat Detail <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $sourceCodes->onEachSide(1)->links() }}
                    </div>
                @endif
            </div>
        </section>
    </article>
@endsection
