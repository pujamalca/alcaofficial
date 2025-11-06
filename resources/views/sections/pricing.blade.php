{{-- Pricing Section --}}
<section id="harga" class="section bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20 animate-on-scroll">
            <span class="badge mb-4">
                <i class="fas fa-tags mr-2"></i> Paket Harga
            </span>
            <h2 class="section-title">Pilih Paket yang Sesuai untuk Anda</h2>
            <p class="section-subtitle">Harga transparan dengan fitur lengkap. Tidak ada biaya tersembunyi!</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
            @forelse($pricingPlans ?? [] as $plan)
                <div class="pricing-card animate-on-scroll {{ $plan->is_featured ? 'featured' : '' }}"
                     data-featured="{{ $plan->is_featured ? 'true' : 'false' }}">

                    @if($plan->is_featured)
                        <div class="pricing-badge">
                            <i class="fas fa-crown mr-2"></i> {{ $plan->badge ?? 'PALING POPULER' }}
                        </div>
                    @elseif($plan->badge)
                        <div class="pricing-badge-simple">
                            {{ $plan->badge }}
                        </div>
                    @endif

                    <div class="pricing-header">
                        <h3 class="text-2xl font-bold mb-2">{{ $plan->name }}</h3>

                        @if($plan->description)
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                                {{ $plan->description }}
                            </p>
                        @endif

                        <div class="pricing-price">
                            @php
                                // Format price with thousand separator
                                $formattedPrice = number_format((float)($plan->price ?? 0), 0, ',', '.');
                            @endphp

                            <span class="price-currency">Rp</span>
                            <span class="price-amount">{{ $formattedPrice }}</span>
                            @if($plan->price_suffix)
                                <span class="price-suffix">{{ $plan->price_suffix }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="pricing-features">
                        @if($plan->features && $plan->features->count() > 0)
                            <ul class="space-y-4">
                                @foreach($plan->features as $feature)
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-blue-600 dark:text-blue-400 mt-1 mr-3 flex-shrink-0"></i>
                                        <span class="text-gray-700 dark:text-gray-200">{{ $feature->feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 dark:text-gray-400 text-sm italic">Tidak ada fitur yang ditampilkan</p>
                        @endif
                    </div>

                    <div class="pricing-cta">
                        @if($plan->cta_url)
                            <a href="{{ $plan->cta_url }}"
                               class="btn-pricing {{ $plan->is_featured ? 'btn-pricing-featured' : '' }}"
                               target="{{ str_starts_with($plan->cta_url, 'http') ? '_blank' : '_self' }}">
                                {{ $plan->cta_text ?? 'Pilih Paket' }}
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        @else
                            <a href="#kontak" class="btn-pricing {{ $plan->is_featured ? 'btn-pricing-featured' : '' }}">
                                {{ $plan->cta_text ?? 'Hubungi Kami' }}
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-box-open text-gray-400 text-6xl mb-4"></i>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">Belum ada paket harga yang ditambahkan.</p>
                        <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">Silakan hubungi kami untuk informasi harga.</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Additional Note --}}
        @if(count($pricingPlans ?? []) > 0)
            <div class="text-center mt-16 animate-on-scroll">
                <p class="text-gray-600 dark:text-gray-300 text-lg">
                    <i class="fas fa-info-circle mr-2 text-blue-600 dark:text-blue-400"></i>
                    Butuh paket khusus atau custom?
                    <a href="#kontak" class="text-blue-600 dark:text-blue-400 font-bold hover:underline">Hubungi kami</a>
                    untuk solusi terbaik!
                </p>
            </div>
        @endif
    </div>
</section>
