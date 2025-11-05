{{-- Hero Section --}}
<section id="beranda" class="hero-section">
@php
    $projectCount = \App\Models\PortfolioItem::where('is_active', true)->count();
    $happyClientsCount = \App\Models\Testimonial::active()->count();
    $averageRatingRaw = \App\Models\Testimonial::active()->avg('rating');
    $averageRating = $averageRatingRaw ? round($averageRatingRaw, 1) : 0;
    $satisfactionPercent = $averageRating > 0
        ? min(100, max(0, round(($averageRating / 5) * 100)))
        : 0;
@endphp
    <div class="hero-bg-pattern"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Content --}}
            <div class="space-y-8 animate-on-scroll">
                <div class="inline-block">
                    <span class="badge animate-pulse-glow">
                        <i class="fas fa-star text-yellow-500 mr-1"></i> #1 Web Development Services
                    </span>
                </div>

                <h1 class="text-5xl lg:text-6xl xl:text-7xl font-black leading-tight">
                    Jasa Pembuatan<br>
                    <span class="text-gradient">Website Professional</span><br>
                    Terbaik di Indonesia
                </h1>

                <p class="text-xl text-gray-600 dark:text-white leading-relaxed">
                    Wujudkan website impian Anda dengan teknologi modern, desain menarik, dan performa maksimal.
                    <strong class="text-blue-600">Harga mulai 500K</strong> dengan kualitas terjamin!
                </p>

                <div class="text-2xl font-bold text-gradient italic mt-2">
                    "Nothing Impossible"
                </div>

                <div class="flex flex-wrap gap-4">
                    <a href="#kontak" class="btn-primary text-lg">
                        <i class="fas fa-rocket mr-2"></i> Mulai Project Sekarang
                    </a>
                    <a href="#portofolio" class="btn-outline text-lg">
                        <i class="fas fa-eye mr-2"></i> Lihat Portfolio
                    </a>
                </div>

                {{-- Trust Badges --}}
                <div class="flex flex-wrap gap-6 pt-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-shield-check text-3xl text-green-500"></i>
                        <div>
                            <div class="text-sm font-bold text-gray-900 dark:text-white">100% Aman</div>
                            <div class="text-xs text-gray-500 dark:text-white">SSL Certificate</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-bolt text-3xl text-yellow-500"></i>
                        <div>
                            <div class="text-sm font-bold text-gray-900 dark:text-white">Super Cepat</div>
                            <div class="text-xs text-gray-500 dark:text-white">Optimized</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-headset text-3xl text-blue-500"></i>
                        <div>
                            <div class="text-sm font-bold text-gray-900 dark:text-white">Support 24/7</div>
                            <div class="text-xs text-gray-500 dark:text-white">Always Ready</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Hero Image --}}
            <div class="relative animate-on-scroll">
                <div class="animate-float">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop"
                         alt="Website Development - {{ config('app.name', 'AlcaOfficial') }}"
                         class="rounded-3xl shadow-2xl w-full"
                         loading="eager">
                </div>

                {{-- Floating Stats --}}
                <div class="absolute -bottom-8 -left-8 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-2xl hidden md:block">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gradient">950+</div>
                            <div class="text-sm text-gray-600 dark:text-white">Happy Clients</div>
                        </div>
                    </div>
                </div>

                <div class="absolute -top-8 -right-8 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-2xl hidden md:block">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center">
                            <i class="fas fa-trophy text-white text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gradient">4.9/5</div>
                            <div class="text-sm text-gray-600 dark:text-white">Rating</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats Section --}}
        <div id="statsSection" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 mt-24">
            <div class="stat-card">
                <div
                    class="stat-number counter"
                    data-target="{{ max($projectCount, 0) }}"
                    data-suffix="+"
                >{{ max($projectCount, 0) }}+</div>
                <div class="text-gray-600 dark:text-white font-semibold mt-2">Project Selesai</div>
            </div>
            <div class="stat-card">
                <div
                    class="stat-number counter"
                    data-target="{{ max($happyClientsCount, 0) }}"
                    data-suffix="+"
                >{{ max($happyClientsCount, 0) }}+</div>
                <div class="text-gray-600 dark:text-white font-semibold mt-2">Klien Puas</div>
            </div>
            <div class="stat-card">
                <div
                    class="stat-number counter"
                    data-target="{{ number_format($averageRating, 1, '.', '') }}"
                    data-decimals="1"
                >{{ number_format($averageRating, 1) }}</div>
                <div class="text-gray-600 dark:text-white font-semibold mt-2">Rating Bintang 5</div>
            </div>
            <div class="stat-card">
                <div
                    class="stat-number counter"
                    data-target="{{ $satisfactionPercent }}"
                    data-suffix="%"
                >{{ $satisfactionPercent }}%</div>
                <div class="text-gray-600 dark:text-white font-semibold mt-2">Kepuasan</div>
            </div>
        </div>
    </div>
</section>
