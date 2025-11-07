@php
    $settings = app(\App\Settings\GeneralSettings::class);
    $landingSettings = app(\App\Settings\LandingPageSettings::class);
    $siteName = $settings->site_name ?? config('app.name', 'AlcaOfficial');
    $siteLogo = $settings->site_logo;
@endphp

<!-- Navbar -->
<nav class="navbar fixed w-full top-0 left-0 z-50">
    <div class="container mx-auto">
        <div class="navbar-inner flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center navbar-logo-link">
                    @if($siteLogo)
                        <img src="{{ asset('storage/' . $siteLogo) }}"
                             alt="{{ $siteName }} Logo"
                             class="navbar-logo-img"
                             width="40"
                             height="40"
                             style="border-radius: 8px;">
                    @else
                        <img src="{{ asset('alca.webp') }}"
                             alt="{{ $siteName }} Logo"
                             class="navbar-logo-img"
                             width="40"
                             height="40"
                             style="border-radius: 8px;">
                    @endif
                    <span class="navbar-logo-text font-black text-gradient ml-3">{{ $siteName }}</span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="{{ url('/') }}"
                   class="nav-link text-base {{ request()->is('/') ? 'text-blue-600' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('services.index') }}"
                   class="nav-link text-base {{ request()->is('layanan*') ? 'text-blue-600' : '' }}">
                    Layanan
                </a>
                <a href="{{ route('portfolio.index') }}"
                   class="nav-link text-base {{ request()->is('portofolio*') ? 'text-blue-600' : '' }}">
                    Portofolio
                </a>
                <a href="{{ url('/#paket') }}"
                   class="nav-link text-base">
                    Harga
                </a>
                <a href="{{ route('blog.index') }}"
                   class="nav-link text-base {{ request()->is('blog*') ? 'text-blue-600' : '' }}">
                    Blog
                </a>
                <a href="{{ route('source-codes.index') }}"
                   class="nav-link text-base {{ request()->is('source-code*') ? 'text-blue-600' : '' }}">
                    Source Code
                </a>
                <a href="{{ url('/#kontak') }}"
                   class="nav-link text-base">
                    Kontak
                </a>
            </div>

            <!-- CTA & Theme Toggle -->
            <div class="flex items-center navbar-actions flex-shrink-0">
                <!-- Theme Toggle Button -->
                <button id="themeToggle"
                        class="navbar-theme-btn rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                        aria-label="Toggle dark mode"
                        data-theme="light">
                    <i class="fas fa-moon theme-icon" data-theme-icon="moon"></i>
                    <i class="fas fa-sun theme-icon is-hidden" data-theme-icon="sun"></i>
                </button>

                @if($landingSettings->show_search)
                    <button
                        type="button"
                        onclick="window.dispatchEvent(new CustomEvent('open-search'))"
                        aria-label="Open search"
                        class="header-search-trigger hidden lg:flex items-center gap-2 px-3 py-2.5 min-h-[44px] text-sm text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors cursor-pointer ml-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span>Search</span>
                    </button>
                @endif

                <!-- CTA Button (Desktop) -->
                <a href="{{ url('/#kontak') }}"
                   class="hidden lg:block btn-primary ml-3">
                    <i class="fas fa-rocket mr-2"></i> Konsultasi Gratis
                </a>

                <!-- Mobile Menu Button -->
                <button
                    id="mobileMenuBtn"
                    class="lg:hidden navbar-menu-btn text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all"
                    aria-label="Toggle mobile menu"
                    aria-controls="mobileMenu"
                    aria-expanded="false"
                    type="button"
                >
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden lg:hidden border-t border-gray-200 dark:border-gray-800">
        <div class="mobile-menu-panel px-4 py-6 space-y-4">
            <a href="{{ url('/') }}"
               class="block py-2 font-semibold hover:text-blue-600 {{ request()->is('/') ? 'text-blue-600' : '' }}">
                Beranda
            </a>
            <a href="{{ route('services.index') }}"
               class="block py-2 font-semibold hover:text-blue-600 {{ request()->is('layanan*') ? 'text-blue-600' : '' }}">
                Layanan
            </a>
            <a href="{{ route('portfolio.index') }}"
               class="block py-2 font-semibold hover:text-blue-600 {{ request()->is('portofolio*') ? 'text-blue-600' : '' }}">
                Portofolio
            </a>
            <a href="{{ url('/#paket') }}"
               class="block py-2 font-semibold hover:text-blue-600">
                Harga
            </a>
            <a href="{{ route('blog.index') }}"
               class="block py-2 font-semibold hover:text-blue-600 {{ request()->is('blog*') ? 'text-blue-600' : '' }}">
                Blog
            </a>
            @if($landingSettings->show_search)
                <button
                    type="button"
                    onclick="window.dispatchEvent(new CustomEvent('open-search'))"
                    class="header-search-trigger block w-full text-left py-2 font-semibold flex items-center gap-2 hover:text-blue-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Search</span>
                </button>
            @endif
            <a href="{{ route('source-codes.index') }}"
               class="block py-2 font-semibold hover:text-blue-600 {{ request()->is('source-code*') ? 'text-blue-600' : '' }}">
                Source Code
            </a>
            <a href="{{ url('/#kontak') }}"
               class="block py-2 font-semibold hover:text-blue-600">
                Kontak
            </a>
            <a href="{{ url('/#kontak') }}"
               class="block btn-primary text-center mt-4">
                <i class="fas fa-rocket mr-2"></i> Konsultasi Gratis
            </a>
        </div>
    </div>
</nav>

{{-- Search Modal --}}
@if($landingSettings->show_search)
    <div x-data="{
        open: false,
        query: '',
        results: [],
        loading: false,
        previouslyFocused: null,
        init() {
            this.$watch('open', value => {
                if (value) {
                    this.trapFocus();
                } else {
                    this.releaseFocus();
                }
            });
        },
        trapFocus() {
            this.previouslyFocused = document.activeElement;
            document.body.style.overflow = 'hidden';
            this.$nextTick(() => {
                if (this.$refs.searchInput) {
                    this.$refs.searchInput.focus();
                }
            });
        },
        releaseFocus() {
            document.body.style.overflow = '';
            if (this.previouslyFocused) {
                this.previouslyFocused.focus();
            }
        },
        async search() {
            if (this.query.length < 1) {
                this.results = [];
                return;
            }
            this.loading = true;
            try {
                const response = await fetch(`/api/search?q=${encodeURIComponent(this.query)}`);
                const data = await response.json();
                this.results = data.data || [];
            } catch (error) {
                console.error('Search error:', error);
                this.results = [];
            } finally {
                this.loading = false;
            }
        },
        goToFirst() {
            if (this.results.length > 0) {
                window.location.href = '/blog/' + this.results[0].slug;
            }
        }
    }"
    @open-search.window="open = true"
    @keydown.escape.window="open = false"
    x-show="open"
    x-cloak
    role="dialog"
    aria-modal="true"
    aria-labelledby="search-title"
    class="fixed inset-0 z-50 overflow-y-auto backdrop-blur-sm bg-black/20 dark:bg-black/40"
    style="display: none;"
    @click="open = false">
        <div class="flex items-start justify-center min-h-screen pt-20 px-4" @click.stop>
            <div x-show="open" x-transition class="search-modal-panel relative bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-4 border-b border-gray-200 dark:border-gray-800">
                    <h2 id="search-title" class="sr-only">Search Articles</h2>
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="search"
                               x-ref="searchInput"
                               x-model="query"
                               @input.debounce.300ms="search()"
                               @keydown.enter="goToFirst()"
                               placeholder="Cari artikel... (min. 1 karakter)"
                               role="searchbox"
                               aria-label="Search articles"
                               aria-describedby="search-help"
                               aria-autocomplete="list"
                               class="search-modal-input w-full pl-12 pr-12 py-3 bg-gray-50 dark:bg-gray-800 border-0 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white dark:focus:bg-gray-800 text-gray-900 dark:text-gray-100 transition-all text-lg">
                    <button @click="open = false"
                            aria-label="Close search"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 focus:ring-2 focus:ring-blue-500 rounded p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <p id="search-help" class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                        <span x-show="query.length === 0" class="text-gray-500">
                            Mulai ketik minimal 1 karakter untuk mencari
                        </span>
                        <span x-show="query.length >= 1 && results.length > 0" class="text-green-600">
                            Ditemukan <span x-text="results.length"></span> artikel
                        </span>
                    </p>
                </div>

                <div class="search-modal-results max-h-96 overflow-y-auto bg-white dark:bg-gray-900">
                    <div x-show="loading" class="p-8 text-center">
                        <div class="inline-block w-8 h-8 border-4 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                        <p class="mt-4 text-gray-600 dark:text-gray-300">Mencari...</p>
                    </div>

                    <div x-show="!loading && query && results.length === 0" class="p-8 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="mt-4 text-gray-600 dark:text-gray-300">Tidak ada hasil ditemukan</p>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Coba kata kunci lain</p>
                    </div>

                    <div x-show="!loading && results.length > 0" class="divide-y divide-gray-100 dark:divide-gray-800">
                        <template x-for="(result, index) in results" :key="result.slug">
                            <a :href="'/blog/' + result.slug"
                               class="block p-4 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1" x-text="result.title"></h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 line-clamp-2" x-text="result.excerpt"></p>
                                <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                                    <span x-text="result.category"></span>
                                    <span x-text="result.reading_time ? result.reading_time + ' min read' : ''"></span>
                                </div>
                            </a>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
