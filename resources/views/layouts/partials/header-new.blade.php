@php
    $settings = app(\App\Settings\GeneralSettings::class);
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
                <a href="{{ url('/#testimoni') }}"
                   class="nav-link text-base">
                    Testimoni
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
            <a href="{{ url('/#testimoni') }}"
               class="block py-2 font-semibold hover:text-blue-600">
                Testimoni
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
