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
                <div class="service-card animate-on-scroll">
                    <div class="service-icon">
                        <i class="{{ $service->icon }}"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">{{ $service->title }}</h3>
                    <p class="text-gray-600 dark:text-white mb-6 leading-relaxed">
                        {{ $service->description }}
                    </p>

                    @if($service->features && count($service->features) > 0)
                        <ul class="space-y-3 mb-6">
                            @foreach($service->features as $feature)
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-blue-600 mt-1 mr-3 flex-shrink-0"></i>
                                    <span>{{ is_array($feature) ? ($feature['name'] ?? $feature['feature'] ?? json_encode($feature)) : $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <a href="{{ route('services.show', $service->slug) }}" class="text-blue-600 dark:text-blue-400 font-bold hover:underline">
                        Pelajari Lebih Lanjut <i class="fas fa-arrow-right ml-2"></i>
                    </a>
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
