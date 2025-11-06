{{-- Services Section --}}
<section id="layanan" class="section section-surface">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20 animate-on-scroll">
            <span class="badge mb-4">
                <i class="fas fa-code mr-2"></i> Layanan Kami
            </span>
            <h2 class="section-title">Solusi Website Development Terlengkap</h2>
            <p class="section-subtitle">Kami menyediakan berbagai layanan pembuatan website sesuai kebutuhan bisnis Anda</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services ?? [] as $service)
                <div class="service-card surface-card overflow-hidden animate-on-scroll">
                    <div class="service-card__gradient">
                        <div class="service-card__icon-wrapper">
                            <i class="{{ $service->icon }}"></i>
                        </div>
                    </div>

                    <div class="service-card__body">
                        <h3 class="service-card__title">{{ $service->title }}</h3>
                        <p class="service-card__description">
                            {{ $service->description }}
                        </p>

                        @if($service->features && count($service->features) > 0)
                            <ul class="service-card__features">
                                @foreach($service->features as $feature)
                                    <li>
                                        <span class="service-card__check">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span>{{ is_array($feature) ? ($feature['name'] ?? $feature['feature'] ?? json_encode($feature)) : $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <a href="{{ route('services.show', $service->slug) }}" class="card-primary-btn gap-2 mt-8">
                            Lihat Detail
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                {{-- Fallback if no services in database --}}
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600 dark:text-gray-400">Belum ada layanan yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
