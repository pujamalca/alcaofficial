@php
    /** @var \App\Settings\LandingPageSettings  */
     = app(\App\Settings\LandingPageSettings::class);

     = static function (?string ): array {
        if (blank()) {
            return [];
        }

         = json_decode(, true);

        return is_array() ?  : [];
    };

     = (->hero_buttons);
     = (->features);
     = App\Models\Service::active()->get();
     = App\Models\PortfolioGroup::with([
        'items' => fn () => ->where('is_active', true)->orderBy('sort_order'),
    ])->active()->get();
     = App\Models\PricingPlan::active()->with([
        'features' => fn () => ->orderBy('sort_order'),
    ])->get();
     = App\Models\Testimonial::active()->get();
     = App\Models\ContactCard::active()->get();
     = (->faqs);

     = filled(->hero_image) = filled($landingSettings->hero_image)
        ? asset('storage/' . ltrim($landingSettings->hero_image, '/'))
        : asset('frontend/alca.webp');

    $primaryButton = collect($heroButtons)->firstWhere('style', 'primary');
    $secondaryButton = collect($heroButtons)->firstWhere('style', 'secondary');
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $landingSettings->hero_title }} | {{ config('app.name') }}</title>
    <meta name="description" content="{{ str($landingSettings->hero_description)->limit(160) }}">

    <link rel="preload" href="{{ asset('frontend/alca.webp') }}" as="image" type="image/webp" fetchpriority="high">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" as="style">
    <link rel="preload" href="https://fonts.gstatic.com/s/inter/v12/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfAZ9hiA.woff2" as="font" type="font/woff2" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" media="print" onload="this.media='all'; this.onload=null;">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"></noscript>

    <link rel="stylesheet" href="{{ asset('frontend/assets/fonts/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/styles.min.css') }}">
    @vite(['resources/css/app.css'])
</head>
<body class="gradient-mesh text-white">
    <nav class="navbar fixed top-0 left-0 z-50 w-full bg-gradient-to-b from-slate-950/95 via-slate-950/70 to-transparent backdrop-blur">
        <div class="container mx-auto flex h-20 items-center justify-between px-4">
            <a href="#" class="flex items-center gap-3">
                <img src="{{ asset('frontend/alca.webp') }}" alt="{{ config('app.name') }}" class="h-12 w-12 rounded-xl" loading="lazy">
                <span class="text-2xl font-black text-white">{{ config('app.name') }}</span>
            </a>

            <div class="hidden items-center gap-10 lg:flex">
                <div class="relative group">
                    <button class="flex items-center gap-2 text-sm font-semibold uppercase tracking-wide text-white/80 transition hover:text-white">
                        Website
                        <i class="fas fa-chevron-down text-xs transition-transform group-focus-within:rotate-180 group-hover:rotate-180"></i>
                    </button>
                    <div class="invisible absolute left-0 top-full mt-3 w-56 rounded-2xl border border-white/10 bg-slate-900/95 p-4 opacity-0 shadow-2xl transition duration-200 group-hover:visible group-hover:opacity-100">
                        <a href="#layanan" class="block rounded-xl px-4 py-2 text-white/80 transition hover:bg-white/10 hover:text-white">Layanan</a>
                        <a href="#portofolio" class="mt-2 block rounded-xl px-4 py-2 text-white/80 transition hover:bg-white/10 hover:text-white">Portofolio</a>
                        <a href="#harga" class="mt-2 block rounded-xl px-4 py-2 text-white/80 transition hover:bg-white/10 hover:text-white">Harga</a>
                        <a href="#testimoni" class="mt-2 block rounded-xl px-4 py-2 text-white/80 transition hover:bg-white/10 hover:text-white">Testimoni</a>
                    </div>
                </div>
                <a href="#keunggulan" class="text-sm font-semibold uppercase tracking-wide text-white/80 transition hover:text-white">Keunggulan</a>
                <a href="#faq" class="text-sm font-semibold uppercase tracking-wide text-white/80 transition hover:text-white">FAQ</a>
                <a href="#kontak" class="text-sm font-semibold uppercase tracking-wide text-white/80 transition hover:text-white">Kontak</a>
            </div>

            <div class="hidden items-center gap-3 lg:flex">
                <a href="{{ route('login') }}" class="rounded-xl border border-white/20 px-5 py-2 text-sm font-semibold text-white/80 transition hover:border-white hover:text-white">Masuk</a>
                <a href="#kontak" class="rounded-xl bg-gradient-to-r from-blue-500 to-indigo-500 px-5 py-2 text-sm font-semibold text-white shadow-lg transition hover:shadow-xl">Konsultasi Gratis</a>
            </div>

            <button class="inline-flex items-center justify-center rounded-xl border border-white/20 p-3 text-white lg:hidden" id="mobileMenuBtn">
                <i class="fas fa-bars text-lg"></i>
            </button>
        </div>

        <div id="mobileMenu" class="hidden border-t border-white/10 bg-slate-950/95 px-6 py-6 lg:hidden">
            <nav class="space-y-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-white/60">Website</p>
                    <div class="mt-3 space-y-2">
                        <a href="#layanan" class="block rounded-lg px-3 py-2 text-white/80 transition hover:bg-white/10 hover:text-white">Layanan</a>
                        <a href="#portofolio" class="block rounded-lg px-3 py-2 text-white/80 transition hover:bg-white/10 hover:text-white">Portofolio</a>
                        <a href="#harga" class="block rounded-lg px-3 py-2 text-white/80 transition hover:bg-white/10 hover:text-white">Harga</a>
                        <a href="#testimoni" class="block rounded-lg px-3 py-2 text-white/80 transition hover:bg-white/10 hover:text-white">Testimoni</a>
                    </div>
                </div>
                <a href="#keunggulan" class="block rounded-lg px-3 py-2 text-white/80 transition hover:bg-white/10 hover:text-white">Keunggulan</a>
                <a href="#faq" class="block rounded-lg px-3 py-2 text-white/80 transition hover:bg-white/10 hover:text-white">FAQ</a>
                <a href="#kontak" class="block rounded-lg px-3 py-2 text-white/80 transition hover:bg-white/10 hover:text-white">Kontak</a>
            </nav>
            <div class="mt-6 flex items-center gap-3">
                <a href="{{ route('login') }}" class="flex-1 rounded-xl border border-white/20 px-4 py-2 text-center text-white/80 transition hover:border-white hover:text-white">Masuk</a>
                <a href="#kontak" class="flex-1 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-500 px-4 py-2 text-center font-semibold text-white shadow-lg transition hover:shadow-xl">Konsultasi</a>
            </div>
        </div>
    </nav>

    <main>
        <section class="relative overflow-hidden pt-28" id="hero">
            <div class="absolute inset-0 opacity-30">
                <div class="absolute -top-32 -left-16 h-80 w-80 rounded-full bg-blue-500 blur-3xl"></div>
                <div class="absolute bottom-0 right-10 h-96 w-96 rounded-full bg-indigo-500 blur-3xl"></div>
            </div>
            <div class="container relative mx-auto grid gap-16 px-6 pt-12 lg:grid-cols-[1.1fr,0.9fr] lg:items-center">
                <div class="space-y-6">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/20 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-white/70">
                        Web Development Specialist
                    </span>
                    <h1 class="text-4xl font-black leading-tight md:text-5xl lg:text-6xl">
                        {{ $landingSettings->hero_title }}
                    </h1>
                    @if(filled($landingSettings->hero_subtitle))
                        <p class="text-2xl font-semibold text-white/80">
                            {{ $landingSettings->hero_subtitle }}
                        </p>
                    @endif
                    <p class="max-w-xl text-lg leading-relaxed text-white/70">
                        {{ $landingSettings->hero_description }}
                    </p>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        @if($primaryButton)
                            <a href="{{ $primaryButton['url'] ?? '#kontak' }}" class="inline-flex items-center gap-3 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-500 px-7 py-4 text-sm font-semibold uppercase tracking-wider text-white shadow-xl transition hover:shadow-2xl">
                                {{ $primaryButton['text'] ?? 'Diskusi Proyek' }}
                                <i class="fas fa-arrow-right text-base"></i>
                            </a>
                        @endif
                        @if($secondaryButton)
                            <a href="{{ $secondaryButton['url'] ?? '#portofolio' }}" class="inline-flex items-center gap-3 rounded-2xl border border-white/20 px-7 py-4 text-sm font-semibold uppercase tracking-wider text-white/80 transition hover:border-white hover:text-white">
                                {{ $secondaryButton['text'] ?? 'Lihat Portofolio' }}
                                <i class="fas fa-play text-sm"></i>
                            </a>
                        @endif
                    </div>

                    @php
    /** @var \App\Settings\LandingPageSettings  */
     = app(\App\Settings\LandingPageSettings::class);

     = static function (?string ): array {
        if (blank()) {
            return [];
        }

         = json_decode(, true);

        return is_array() ?  : [];
    };

     = (->hero_buttons);
     = (->features);
     = App\Models\Service::active()->get();
     = App\Models\PortfolioGroup::with([
        'items' => fn () => ->where('is_active', true)->orderBy('sort_order'),
    ])->active()->get();
     = App\Models\PricingPlan::active()->with([
        'features' => fn () => ->orderBy('sort_order'),
    ])->get();
     = App\Models\Testimonial::active()->get();
     = App\Models\ContactCard::active()->get();
     = (->faqs);

     = filled(->hero_image) }}" alt="{{ $landingSettings->hero_title }}" class="h-full w-full object-cover" loading="lazy">
                        <div class="absolute inset-x-0 bottom-0 flex items-center gap-4 bg-gradient-to-t from-slate-950/90 to-transparent p-6">
                            <div class="rounded-xl bg-white/15 p-3">
                                <i class="fas fa-shield-halved text-lg text-emerald-300"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-white/70">Keamanan & Kualitas</p>
                                <p class="text-base font-bold text-white">Tim berpengalaman siap membantu bisnis Anda berkembang.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="layanan" class="relative bg-slate-950 py-24">
            <div class="absolute inset-0 opacity-30">
                <div class="absolute left-10 top-0 h-72 w-72 rounded-full bg-blue-500 blur-3xl"></div>
                <div class="absolute bottom-0 right-20 h-80 w-80 rounded-full bg-indigo-500 blur-3xl"></div>
            </div>
            <div class="relative z-10 container mx-auto px-6">
                <div class="mx-auto max-w-3xl text-center">
                    <span class="badge">Layanan Kami</span>
                    <h2 class="section-title text-white">{{ $landingSettings->services_title }}</h2>
                    @if(filled($landingSettings->services_subtitle))
                        <p class="section-subtitle text-white/70">{{ $landingSettings->services_subtitle }}</p>
                    @endif
                </div>

                <div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($services as $service)
                        <div class="card-gradient group h-full rounded-3xl border border-white/10 bg-white/5 p-8 backdrop-blur transition hover:border-white/25">
                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 text-white shadow-xl">
                                @if(filled($service['icon'] ?? null))
                                    <x-dynamic-component :component="$service['icon']" class="h-6 w-6" />
                                @else
                                    <i class="fas fa-bolt text-lg"></i>
                                @endif
                            </div>
                            <h3 class="mt-6 text-xl font-bold text-white">{{ $service['title'] ?? 'Layanan' }}</h3>
                            @if(filled($service['description'] ?? null))
                                <p class="mt-3 text-white/70">{{ $service['description'] }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-full text-center text-white/60">
                            Data layanan belum tersedia.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        <section id="keunggulan" class="bg-slate-900 py-24">
            <div class="container mx-auto px-6">
                <div class="mx-auto max-w-3xl text-center">
                    <span class="badge">Keunggulan</span>
                    <h2 class="section-title text-white">{{ $landingSettings->features_title }}</h2>
                    @if(filled($landingSettings->features_subtitle))
                        <p class="section-subtitle text-white/70">{{ $landingSettings->features_subtitle }}</p>
                    @endif
                </div>

                <div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($features as $feature)
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-8 backdrop-blur transition hover:-translate-y-1 hover:border-white/25">
                            <div class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600/10 text-blue-400">
                                @if(filled($feature['icon'] ?? null))
                                    <x-dynamic-component :component="$feature['icon']" class="h-6 w-6" />
                                @else
                                    <i class="fas fa-check text-lg"></i>
                                @endif
                            </div>
                            <h3 class="text-xl font-semibold text-white">{{ $feature['title'] ?? 'Fitur' }}</h3>
                            @if(filled($feature['description'] ?? null))
                                <p class="mt-3 text-white/70">{{ $feature['description'] }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-full text-center text-white/60">
                            Data keunggulan belum diatur.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        <section id="portofolio" class="bg-slate-950 py-24">
            <div class="container mx-auto px-6" x-data="{ active: 0 }">
                <div class="mx-auto max-w-3xl text-center text-white">
                    <span class="badge">Portofolio</span>
                    <h2 class="section-title">{{ $landingSettings->portfolio_title }}</h2>
                    @if(filled($landingSettings->portfolio_subtitle))
                        <p class="section-subtitle text-white/70">{{ $landingSettings->portfolio_subtitle }}</p>
                    @endif
                </div>

                <div class="mt-12 flex flex-wrap justify-center gap-3">
                    @foreach($portfolioGroups as $index => $group)
                        <button type="button" @click="active = {{ $index }}" :class="active === {{ $index }} ? 'bg-white text-slate-900 shadow-lg' : 'bg-white/10 text-white/70 hover:bg-white/20'" class="rounded-full px-5 py-2 text-sm font-semibold transition">
                            {{ $group['label'] ?? 'Kategori' }}
                        </button>
                    @endforeach
                </div>

                @foreach($portfolioGroups as $index => $group)
                    <div x-show="active === {{ $index }}" x-transition x-cloak class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($group['items'] as $item)
                            @php
                                $image = filled($item['image'] ?? null) ? asset('storage/' . ltrim($item['image'], '/')) : null;
                            @endphp
                            <div class="flex h-full flex-col overflow-hidden rounded-3xl border border-white/10 bg-white/5 backdrop-blur">
                                @if($image)
                                    <img src="{{ $image }}" alt="{{ $item['title'] ?? 'Portofolio' }}" class="h-48 w-full object-cover" loading="lazy">
                                @else
                                    <div class="flex h-48 items-center justify-center bg-gradient-to-br from-blue-600 to-indigo-600">
                                        <i class="fas fa-image text-4xl text-white/40"></i>
                                    </div>
                                @endif
                                <div class="flex flex-1 flex-col space-y-4 p-6 text-white">
                                    <div class="space-y-2">
                                        @if(filled($item['category'] ?? null))
                                            <span class="badge badge-light">{{ $item['category'] }}</span>
                                        @endif
                                        <h3 class="text-xl font-semibold">{{ $item['title'] ?? 'Project' }}</h3>
                                    </div>
                                    @if(filled($item['description'] ?? null))
                                        <p class="flex-1 text-sm text-white/70">{{ $item['description'] }}</p>
                                    @endif
                                    @if(filled($item['url'] ?? null))
                                        <a href="{{ $item['url'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-300 hover:text-emerald-200">
                                            Lihat Proyek
                                            <i class="fas fa-arrow-up-right-from-square text-xs"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                @if(empty($portfolioGroups))
                    <p class="mt-12 text-center text-white/60">Data portofolio belum tersedia.</p>
                @endif
            </div>
        </section>
        <section id="harga" class="bg-slate-900 py-24 text-white">
            <div class="container mx-auto px-6">
                <div class="mx-auto max-w-3xl text-center">
                    <span class="badge">Paket Harga</span>
                    <h2 class="section-title">{{ $landingSettings->pricing_title }}</h2>
                    @if(filled($landingSettings->pricing_subtitle))
                        <p class="section-subtitle text-white/70">{{ $landingSettings->pricing_subtitle }}</p>
                    @endif
                </div>

                <div class="mt-14 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($pricingPlans as $plan)
                        @php
                            $featured = (bool)($plan['is_featured'] ?? false);
                        @endphp
                        <div class="relative flex h-full flex-col rounded-3xl border {{ $featured ? 'border-blue-500 shadow-2xl bg-white text-slate-900' : 'border-white/10 bg-white/5 backdrop-blur' }} p-8 transition hover:-translate-y-1">
                            @if(filled($plan['badge'] ?? null))
                                <span class="absolute -top-3 right-6 rounded-full px-4 py-1 text-xs font-semibold uppercase tracking-wide {{ $featured ? 'bg-blue-600 text-white' : 'bg-white/20 text-white' }}">
                                    {{ $plan['badge'] }}
                                </span>
                            @endif

                            <div>
                                <p class="text-sm font-semibold uppercase tracking-wide {{ $featured ? 'text-blue-600' : 'text-white/60' }}">{{ $plan['name'] }}</p>
                                <h3 class="mt-3 text-3xl font-black">{{ $plan['price'] }}</h3>
                                @if(filled($plan['price_suffix'] ?? null))
                                    <p class="text-xs uppercase tracking-wider {{ $featured ? 'text-slate-500' : 'text-white/50' }}">{{ $plan['price_suffix'] }}</p>
                                @endif
                            </div>

                            @if(filled($plan['description'] ?? null))
                                <p class="mt-4 text-sm {{ $featured ? 'text-slate-600' : 'text-white/70' }}">{{ $plan['description'] }}</p>
                            @endif

                            @if(count($plan['features']) > 0)
                                <ul class="mt-6 space-y-3 text-sm {{ $featured ? 'text-slate-600' : 'text-white/70' }}">
                                    @foreach($plan['features'] as $feature)
                                        <li class="flex items-start gap-3">
                                            <span class="mt-1 inline-flex h-5 w-5 items-center justify-center rounded-full {{ $featured ? 'bg-blue-600 text-white' : 'bg-white/20 text-emerald-300' }}">
                                                <i class="fas fa-check text-[10px]"></i>
                                            </span>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            @if(filled($plan['cta_text'] ?? null))
                                <a href="{{ $plan['cta_url'] ?? '#kontak' }}" class="mt-10 inline-flex items-center justify-center gap-2 rounded-2xl px-6 py-3 text-sm font-semibold uppercase tracking-widest {{ $featured ? 'bg-slate-900 text-white hover:bg-slate-950' : 'bg-white/10 text-white hover:bg-white/20' }}">
                                    {{ $plan['cta_text'] }}
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            @endif
                        </div>
                    @empty
                        <p class="col-span-full text-center text-white/60">Data harga belum tersedia.</p>
                    @endforelse
                </div>
            </div>
        </section>
        <section id="testimoni" class="bg-slate-950 py-24">
            <div class="container mx-auto px-6">
                <div class="mx-auto max-w-2xl text-center text-white">
                    <span class="badge">Testimoni</span>
                    <h2 class="section-title">{{ $landingSettings->testimonials_title }}</h2>
                    @if(filled($landingSettings->testimonials_subtitle))
                        <p class="section-subtitle text-white/70">{{ $landingSettings->testimonials_subtitle }}</p>
                    @endif
                </div>

                <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($testimonials as $testimonial)
                        @php
                            $avatar = filled($testimonial['avatar'] ?? null) ? asset('storage/' . ltrim($testimonial['avatar'], '/')) : null;
                            $rating = max(0, min(5, (float)($testimonial['rating'] ?? 5)));
                        @endphp
                        <div class="flex h-full flex-col rounded-3xl border border-white/10 bg-white/5 p-8 backdrop-blur">
                            <div class="flex items-center gap-4">
                                @if($avatar)
                                    <img src="{{ $avatar }}" alt="{{ $testimonial['name'] ?? 'Klien' }}" class="h-14 w-14 rounded-full object-cover" loading="lazy">
                                @else
                                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-indigo-500 text-lg font-bold text-white">
                                        {{ strtoupper(substr($testimonial['name'] ?? 'A', 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="text-lg font-semibold text-white">{{ $testimonial['name'] ?? 'Klien' }}</p>
                                    @if(filled($testimonial['role'] ?? null))
                                        <p class="text-sm text-white/60">{{ $testimonial['role'] }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-5 flex items-center gap-1 text-amber-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= round($rating) ? '' : 'text-white/20' }}"></i>
                                @endfor
                            </div>
                            @if(filled($testimonial['quote'] ?? null))
                                <p class="mt-5 flex-1 text-sm text-white/70">Ã¢â‚¬Å“{{ $testimonial['quote'] }}Ã¢â‚¬Â</p>
                            @endif
                        </div>
                    @empty
                        <p class="col-span-full text-center text-white/60">Belum ada testimoni.</p>
                    @endforelse
                </div>
            </div>
        </section>
        <section class="bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 py-20 text-white">
            <div class="container mx-auto flex flex-col items-center justify-between gap-8 px-6 lg:flex-row">
                <div class="max-w-xl space-y-4 text-center lg:text-left">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-white/80">Siap Mulai?</p>
                    <h2 class="text-3xl font-bold md:text-4xl">{{ $landingSettings->cta_title }}</h2>
                    @if(filled($landingSettings->cta_description))
                        <p class="text-white/80">{{ $landingSettings->cta_description }}</p>
                    @endif
                </div>
                <a href="{{ $landingSettings->cta_button_url }}" class="inline-flex items-center gap-3 rounded-2xl bg-white px-8 py-4 text-sm font-semibold uppercase tracking-[0.3em] text-slate-900 shadow-xl transition hover:shadow-2xl">
                    {{ $landingSettings->cta_button_text }}
                    <i class="fas fa-arrow-right text-base"></i>
                </a>
            </div>
        </section>

        <section id="kontak" class="bg-slate-900 py-24">
            <div class="container mx-auto grid gap-12 px-6 lg:grid-cols-[1.1fr,0.9fr]">
                <div>
                    <span class="badge">Hubungi Kami</span>
                    <h2 class="section-title text-white">{{ $landingSettings->contact_title }}</h2>
                    @if(filled($landingSettings->contact_subtitle))
                        <p class="section-subtitle text-white/70">{{ $landingSettings->contact_subtitle }}</p>
                    @endif
                    @if(filled($landingSettings->contact_description))
                        <p class="mt-6 max-w-xl text-white/60">{{ $landingSettings->contact_description }}</p>
                    @endif

                    <div class="mt-10 space-y-4">
                        @forelse($contactCards as $card)
                            <div class="flex items-start gap-4 rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                                <div class="rounded-xl bg-gradient-to-br from-emerald-400 to-cyan-400 p-3 text-slate-900">
                                    @if(filled($card['icon'] ?? null))
                                        <x-dynamic-component :component="$card['icon']" class="h-6 w-6" />
                                    @else
                                        <i class="fas fa-phone"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold uppercase tracking-widest text-white/60">{{ $card['title'] ?? 'Kontak' }}</p>
                                    @if(filled($card['value'] ?? null))
                                        @if(filled($card['link'] ?? null))
                                            <a href="{{ $card['link'] }}" target="_blank" rel="noopener" class="mt-1 block text-lg font-semibold text-white hover:text-emerald-300">
                                                {{ $card['value'] }}
                                            </a>
                                        @else
                                            <p class="mt-1 text-lg font-semibold text-white">{{ $card['value'] }}</p>
                                        @endif
                                    @endif
                                    @if(filled($card['description'] ?? null))
                                        <p class="mt-2 text-sm text-white/60">{{ $card['description'] }}</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-white/60">Informasi kontak belum tersedia.</p>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-8 text-slate-900 shadow-2xl" x-data="{ submitted: false }">
                    <div x-show="!submitted" x-transition>
                        <h3 class="text-2xl font-bold">{{ $landingSettings->contact_form_title }}</h3>
                        @if(filled($landingSettings->contact_form_subtitle))
                            <p class="mt-3 text-slate-600">{{ $landingSettings->contact_form_subtitle }}</p>
                        @endif

                        <form class="mt-8 space-y-6" @submit.prevent="submitted = true">
                            <div class="grid gap-6 sm:grid-cols-2">
                                <div>
                                    <label class="text-sm font-semibold text-slate-600">Nama</label>
                                    <input type="text" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring focus:ring-blue-200" placeholder="Nama Anda">
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-slate-600">Email</label>
                                    <input type="email" required class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring focus:ring-blue-200" placeholder="email@domain.com">
                                </div>
                            </div>
                            <div class="grid gap-6 sm:grid-cols-2">
                                <div>
                                    <label class="text-sm font-semibold text-slate-600">Nomor WhatsApp</label>
                                    <input type="tel" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring focus:ring-blue-200" placeholder="+62 8xx-xxxx-xxxx">
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-slate-600">Perkiraan Budget</label>
                                    <select class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring focus:ring-blue-200">
                                        <option value="">Pilih kisaran</option>
                                        <option value="500k-2jt">Rp 500K - 2 Juta</option>
                                        <option value="2jt-5jt">Rp 2 Juta - 5 Juta</option>
                                        <option value="5jt-10jt">Rp 5 Juta - 10 Juta</option>
                                        <option value="10jt+">Lebih dari Rp 10 Juta</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-slate-600">Deskripsi Project</label>
                                <textarea rows="4" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring focus:ring-blue-200" placeholder="Ceritakan kebutuhan Anda"></textarea>
                            </div>
                            <button type="submit" class="flex w-full items-center justify-center gap-3 rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-slate-950">
                                Kirim Pesan
                                <i class="fas fa-paper-plane text-base"></i>
                            </button>
                        </form>
                    </div>
                    <div x-show="submitted" x-transition x-cloak class="py-16 text-center">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 text-emerald-500">
                            <i class="fas fa-check text-3xl"></i>
                        </div>
                        <h3 class="mt-6 text-2xl font-bold">{{ $landingSettings->contact_form_success_message }}</h3>
                        <p class="mt-3 text-slate-600">Tim kami akan segera menghubungi Anda.</p>
                        <button type="button" class="mt-8 inline-flex items-center gap-2 rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-950" @click="submitted = false">
                            Kirim Pesan Baru
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <section id="faq" class="bg-slate-950 py-24">
            <div class="container mx-auto max-w-4xl px-6 text-white">
                <div class="text-center">
                    <span class="badge">FAQ</span>
                    <h2 class="section-title">{{ $landingSettings->faq_title }}</h2>
                    @if(filled($landingSettings->faq_subtitle))
                        <p class="section-subtitle text-white/70">{{ $landingSettings->faq_subtitle }}</p>
                    @endif
                </div>

                <div class="mt-12 space-y-4">
                    @forelse($faqs as $index => $faq)
                        <div x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }" class="overflow-hidden rounded-3xl border border-white/10 bg-white/5 backdrop-blur">
                            <button type="button" class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left" @click="open = !open">
                                <span class="text-lg font-semibold text-white">{{ $faq['question'] ?? 'Pertanyaan' }}</span>
                                <i class="fas fa-chevron-down text-sm transition-transform" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="open" x-transition x-cloak class="border-t border-white/5 px-6 pb-6 text-sm text-white/70">
                                {{ $faq['answer'] ?? '' }}
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-white/60">Belum ada FAQ yang ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-slate-950/95 border-t border-white/10 py-12 text-white">
        <div class="container mx-auto grid gap-10 px-6 lg:grid-cols-4">
            <div>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('frontend/alca.webp') }}" alt="{{ config('app.name') }}" class="h-12 w-12 rounded-xl" loading="lazy">
                    <span class="text-2xl font-black">{{ config('app.name') }}</span>
                </div>
                <p class="mt-4 text-sm text-white/70">{{ $landingSettings->hero_description }}</p>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.3em] text-white/60">Website</h4>
                <ul class="mt-4 space-y-2 text-sm text-white/70">
                    <li><a href="#layanan" class="transition hover:text-white">Layanan</a></li>
                    <li><a href="#portofolio" class="transition hover:text-white">Portofolio</a></li>
                    <li><a href="#harga" class="transition hover:text-white">Harga</a></li>
                    <li><a href="#testimoni" class="transition hover:text-white">Testimoni</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.3em] text-white/60">Informasi</h4>
                <ul class="mt-4 space-y-2 text-sm text-white/70">
                    <li><a href="#keunggulan" class="transition hover:text-white">Keunggulan</a></li>
                    <li><a href="#faq" class="transition hover:text-white">FAQ</a></li>
                    <li><a href="{{ route('blog.index') }}" class="transition hover:text-white">Blog</a></li>
                    <li><a href="{{ route('login') }}" class="transition hover:text-white">Masuk Admin</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-[0.3em] text-white/60">Hubungi</h4>
                <ul class="mt-4 space-y-2 text-sm text-white/70">
                    @foreach($contactCards as $card)
                        @if(filled($card['value'] ?? null))
                            <li>{{ $card['value'] }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mt-10 border-t border-white/10 pt-6 text-center text-xs text-white/50">
            Ã‚Â© {{ now()->year }} {{ config('app.name') }}. All rights reserved.
        </div>
    </footer>


    <script src="{{ asset('frontend/script.min.js') }}" defer></script>
    @vite(['resources/js/app.js'])
</body>
</html>


