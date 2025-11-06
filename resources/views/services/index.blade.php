@extends('layouts.app')

@section('title', 'Layanan Kami - ' . config('app.name'))
@section('meta_description', 'Jelajahi berbagai layanan pengembangan web dan aplikasi yang kami tawarkan. Mulai dari Laravel Development, API Development, hingga Website Company Profile.')

@push('meta')
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('services.index') }}">
    <meta property="og:title" content="Layanan Kami - {{ config('app.name') }}">
    <meta property="og:description" content="Jelajahi berbagai layanan pengembangan web dan aplikasi yang kami tawarkan. Mulai dari Laravel Development, API Development, hingga Website Company Profile.">
    <meta property="og:image" content="{{ asset('alca.webp') }}">

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ route('services.index') }}">
    <meta property="twitter:title" content="Layanan Kami - {{ config('app.name') }}">
    <meta property="twitter:description" content="Jelajahi berbagai layanan pengembangan web dan aplikasi yang kami tawarkan.">
    <meta property="twitter:image" content="{{ asset('alca.webp') }}">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ route('services.index') }}">
@endpush



@section('content')
{{-- Page Header --}}
<section class="section section-gradient section-overlay text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <span class="badge mb-4">
                <i class="fas fa-cog mr-2"></i> Layanan
            </span>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Layanan Kami</h1>
            <p class="text-xl text-white/85">
                Solusi teknologi terbaik untuk bisnis Anda
            </p>
        </div>
    </div>
</section>

{{-- Services Grid --}}
<section class="section section-muted py-16">
    <div class="container mx-auto px-4">
        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-700/70">
                        {{-- Service Icon --}}
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-8 text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full">
                                <i class="{{ $service->icon }} text-4xl text-blue-600"></i>
                            </div>
                        </div>

                        {{-- Service Content --}}
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                                {{ $service->title }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-200 mb-4 leading-relaxed line-clamp-3">
                                {{ $service->description }}
                            </p>

                            {{-- Features Preview --}}
                            @if($service->features && count($service->features) > 0)
                                <ul class="space-y-2 mb-6">
                                    @foreach(array_slice($service->features, 0, 3) as $feature)
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-sm text-gray-700 dark:text-gray-200">{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                    @if(count($service->features) > 3)
                                        <li class="text-sm text-gray-500 dark:text-gray-400 ml-7">
                                            +{{ count($service->features) - 3 }} fitur lainnya
                                        </li>
                                    @endif
                                </ul>
                            @endif

                            {{-- CTA Button --}}
                            <a href="{{ route('services.show', $service->slug) }}"
                               class="inline-flex items-center justify-center w-full px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                Lihat Detail
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-16">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada layanan</h3>
                    <p class="mt-2 text-gray-500">Layanan akan segera tersedia.</p>
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
                <h2 class="text-4xl md:text-5xl font-black mb-6">Butuh Solusi Custom?</h2>
                <p class="text-xl text-white leading-relaxed mb-10">
                    Konsultasikan kebutuhan proyek Anda dengan tim profesional kami.
                </p>
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="https://wa.me/6288101018577?text=Halo%20AlcaOfficial,%20saya%20tertarik%20dengan%20layanan%20Anda"
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
