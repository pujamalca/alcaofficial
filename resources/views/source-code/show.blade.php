@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $metaDescription = $sourceCode->meta_description
        ?? Str::limit($sourceCode->short_description ?? strip_tags($sourceCode->description), 155);
@endphp

@section('title', ($sourceCode->meta_title ?: $sourceCode->title . ' - Source Code Premium') . ' | ' . config('app.name'))
@section('meta_description', $metaDescription)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/source-code.css') }}">
@endpush

@section('content')
    <article class="source-detail-page">
        {{-- Hero --}}
        <section class="source-detail-hero">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <span class="hero-breadcrumb">
                    <a href="{{ url('/') }}">Beranda</a>
                    <i class="fas fa-chevron-right mx-2"></i>
                    <a href="{{ route('source-codes.index') }}">Source Code</a>
                    <i class="fas fa-chevron-right mx-2"></i>
                    <span>{{ $sourceCode->title }}</span>
                </span>

                <div class="mt-6 flex flex-wrap items-center gap-4">
                    <span class="hero-category">
                        <i class="fas fa-layer-group mr-2"></i>
                        {{ $sourceCode->category->name ?? 'Source Code' }}
                    </span>
                    @if($sourceCode->version)
                        <span class="hero-meta">
                            <i class="fas fa-code-branch mr-2"></i>
                            Versi {{ $sourceCode->version }}
                        </span>
                    @endif
                    <span class="hero-meta">
                        <i class="fas fa-eye mr-2"></i>
                        {{ number_format($sourceCode->views_count) }} views
                    </span>
                    <span class="hero-meta">
                        <i class="fas fa-download mr-2"></i>
                        {{ number_format($sourceCode->downloads_count) }} downloads
                    </span>
                </div>

                <h1 class="hero-title mt-6">
                    {{ $sourceCode->title }}
                </h1>

                @if($sourceCode->short_description)
                    <p class="hero-subtitle mt-4">
                        {{ $sourceCode->short_description }}
                    </p>
                @endif
            </div>
        </section>

        {{-- Main Content --}}
        <section class="source-detail-content">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
                <div class="grid lg:grid-cols-12 gap-10">
                    {{-- Main --}}
                    <div class="lg:col-span-8 space-y-10">
                        {{-- Preview --}}
                        @php
                            $previewImages = $sourceCode->preview_images ?? [];
                            if (!is_array($previewImages)) {
                                $previewImages = [];
                            }
                            $thumbnail = $sourceCode->thumbnail;
                            $featuredImage = $thumbnail
                                ? (Str::startsWith($thumbnail, ['http://', 'https://']) ? $thumbnail : Storage::url($thumbnail))
                                : null;
                        @endphp

                        @if($featuredImage || count($previewImages))
                            <div class="source-preview-gallery">
                                @if($featuredImage)
                                    <img src="{{ $featuredImage }}"
                                         alt="Preview {{ $sourceCode->title }}"
                                         class="preview-main"
                                         loading="lazy">
                                @endif

                                @if(count($previewImages))
                                    <div class="preview-grid">
                                        @foreach($previewImages as $image)
                                            @php
                                                $imageUrl = Str::startsWith($image, ['http://', 'https://']) ? $image : Storage::url($image);
                                            @endphp
                                            <img src="{{ $imageUrl }}"
                                                 alt="Preview tambahan {{ $sourceCode->title }}"
                                                 loading="lazy">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif

                        {{-- Description --}}
                        @if($sourceCode->description)
                            <section class="source-section">
                                <h2>Deskripsi Produk</h2>
                                <div class="prose prose-lg max-w-none text-gray-600 dark:text-gray-200">
                                    {!! nl2br(e($sourceCode->description)) !!}
                                </div>
                            </section>
                        @endif

                        {{-- Features --}}
                        @if(!empty($sourceCode->features))
                            <section class="source-section">
                                <h2>Fitur Utama</h2>
                                <div class="feature-list">
                                    @foreach($sourceCode->features as $feature)
                                        <div class="feature-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>{{ is_array($feature) ? ($feature['name'] ?? json_encode($feature)) : $feature }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        {{-- Tech Stack --}}
                        @if(!empty($sourceCode->tech_stack))
                            <section class="source-section">
                                <h2>Teknologi yang Digunakan</h2>
                                <div class="tech-stack">
                                    @foreach($sourceCode->tech_stack as $stack)
                                        <span class="tech-chip">{{ $stack }}</span>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        {{-- Requirements --}}
                        @if($sourceCode->requirements)
                            <section class="source-section">
                                <h2>Kebutuhan Sistem</h2>
                                <ul class="requirements-list">
                                    @foreach(preg_split("/\\r\\n|\\r|\\n/", $sourceCode->requirements) as $requirement)
                                        @if(!blank($requirement))
                                            <li>
                                                <i class="fas fa-rocket"></i>
                                                <span>{{ $requirement }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </section>
                        @endif

                        {{-- Documentation & Demo --}}
                        @if($sourceCode->demo_link || $sourceCode->documentation_link)
                            <section class="source-section">
                                <h2>Demo & Dokumentasi</h2>
                                <div class="resource-buttons">
                                    @if($sourceCode->demo_link)
                                        <a href="{{ $sourceCode->demo_link }}" target="_blank" class="resource-btn">
                                            <i class="fas fa-desktop mr-2"></i> Lihat Demo
                                        </a>
                                    @endif
                                    @if($sourceCode->documentation_link)
                                        <a href="{{ $sourceCode->documentation_link }}" target="_blank" class="resource-btn secondary">
                                            <i class="fas fa-book mr-2"></i> Dokumentasi
                                        </a>
                                    @endif
                                </div>
                            </section>
                        @endif
                    </div>

                    {{-- Sidebar --}}
                    <aside class="lg:col-span-4">
                        @php
                            $effectivePrice = $sourceCode->effective_price ?? 0;
                            $formattedEffective = number_format((float) $effectivePrice, 0, ',', '.');
                            $hasDiscount = $sourceCode->has_discount ?? false;
                            $formattedOriginal = $hasDiscount ? number_format((float) ($sourceCode->price ?? 0), 0, ',', '.') : null;
                        @endphp

                        <div class="source-summary-card">
                            <div class="price-block">
                                <div>
                                    <span class="currency">{{ $sourceCode->currency ?? 'Rp' }}</span>
                                    <span class="amount">{{ $formattedEffective }}</span>
                                    @if($hasDiscount && $formattedOriginal)
                                        <span class="original">Rp {{ $formattedOriginal }}</span>
                                    @endif
                                </div>
                                @if($sourceCode->has_discount)
                                    <span class="discount-badge">Hemat {{ $sourceCode->discount_percentage }}%</span>
                                @endif
                            </div>

                            <div class="cta-buttons">
                                @if($sourceCode->external_link)
                                    <a href="{{ $sourceCode->external_link }}"
                                       target="_blank"
                                       class="primary-btn">
                                        <i class="fas fa-shopping-cart mr-2"></i> Beli Sekarang
                                    </a>
                                @elseif($sourceCode->file_path)
                                    <a href="#kontak" class="primary-btn">
                                        <i class="fas fa-handshake mr-2"></i> Hubungi untuk Pembelian
                                    </a>
                                @endif

                                @if($sourceCode->demo_link)
                                    <a href="{{ $sourceCode->demo_link }}"
                                       target="_blank"
                                       class="secondary-btn">
                                        <i class="fas fa-desktop mr-2"></i> Lihat Demo
                                    </a>
                                @endif

                                <a href="https://wa.me/6288101018577?text=Halo%2C%20saya%20tertarik%20dengan%20source%20code%20{{ urlencode($sourceCode->title) }}"
                                   target="_blank"
                                   class="secondary-btn">
                                    <i class="fab fa-whatsapp mr-2"></i> Konsultasi via WhatsApp
                                </a>
                            </div>

                            <ul class="summary-meta">
                                <li>
                                    <span class="label">Update Terakhir</span>
                                    <span class="value">{{ $sourceCode->updated_at->translatedFormat('d F Y') }}</span>
                                </li>
                                <li>
                                    <span class="label">Lisensi</span>
                                    <span class="value">Komersial</span>
                                </li>
                                <li>
                                    <span class="label">Format</span>
                                    <span class="value">{{ strtoupper($sourceCode->upload_type) }}</span>
                                </li>
                                @if($sourceCode->rating)
                                    <li>
                                        <span class="label">Rating Pengguna</span>
                                        <span class="value">
                                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                                            {{ number_format($sourceCode->rating, 1) }}/5
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="source-contact-card">
                            <h3>Butuh Penyesuaian?</h3>
                            <p>Tim kami siap membantu melakukan kustomisasi sesuai kebutuhan bisnis Anda.</p>
                            <a href="#kontak" class="contact-btn">
                                <i class="fas fa-paper-plane mr-2"></i> Diskusikan Sekarang
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        {{-- Related --}}
        @if($relatedSourceCodes->isNotEmpty())
            <section class="source-related-section">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                    <div class="section-heading text-center mb-12">
                        <span class="section-badge">
                            <i class="fas fa-code-branch mr-2"></i> Produk Lainnya
                        </span>
                        <h2 class="section-title">Source Code Terkait</h2>
                        <p class="section-subtitle">
                            Jelajahi koleksi lain yang mungkin sesuai dengan kebutuhan proyek Anda.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach($relatedSourceCodes as $related)
                            @php
                                $relatedThumb = $related->thumbnail;
                                $relatedThumbUrl = $relatedThumb
                                    ? (Str::startsWith($relatedThumb, ['http://', 'https://'])
                                        ? $relatedThumb
                                        : Storage::url($relatedThumb))
                                    : null;
                                $relatedPrice = number_format((float) ($related->effective_price ?? 0), 0, ',', '.');
                            @endphp
                            <article class="related-card">
                                <a href="{{ route('source-codes.show', $related->slug) }}" class="related-thumb">
                                    @if($relatedThumbUrl)
                                        <img src="{{ $relatedThumbUrl }}" alt="{{ $related->title }}" loading="lazy">
                                    @else
                                        <div class="placeholder">
                                            <i class="fas fa-laptop-code"></i>
                                        </div>
                                    @endif
                                </a>
                                <div class="related-body">
                                    <span class="related-category">{{ $related->category->name ?? 'Source Code' }}</span>
                                    <h3 class="related-title">
                                        <a href="{{ route('source-codes.show', $related->slug) }}">
                                            {{ $related->title }}
                                        </a>
                                    </h3>
                                    <p class="related-price">{{ $related->currency ?? 'Rp' }} {{ $relatedPrice }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </article>
@endsection
