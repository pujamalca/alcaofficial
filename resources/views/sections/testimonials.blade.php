{{-- Testimonials Section --}}
<section id="testimoni" class="section section-surface">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20 animate-on-scroll">
            <span class="badge mb-4">
                <i class="fas fa-comments mr-2"></i> Testimoni
            </span>
            <h2 class="section-title">Apa Kata Klien Kami?</h2>
            <p class="section-subtitle">Kepuasan klien adalah prioritas utama kami. Lihat apa yang mereka katakan!</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($testimonials ?? [] as $testimonial)
                <div class="testimonial-card animate-on-scroll">
                    {{-- Quote Icon --}}
                    <div class="testimonial-quote-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>

                    {{-- Star Rating --}}
                    <div class="flex items-center mb-4">
                        @php
                            $rating = $testimonial->rating ?? 0;
                            $fullStars = floor($rating);
                            $hasHalfStar = ($rating - $fullStars) >= 0.5;
                        @endphp

                        <div class="flex items-center text-yellow-500">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
                                    <i class="fas fa-star text-lg"></i>
                                @elseif($i == $fullStars + 1 && $hasHalfStar)
                                    <i class="fas fa-star-half-alt text-lg"></i>
                                @else
                                    <i class="far fa-star text-lg"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="ml-2 font-semibold text-gray-700 dark:text-gray-300">{{ number_format($rating, 1) }}</span>
                    </div>

                    {{-- Testimonial Quote --}}
                    <p class="testimonial-quote text-gray-700 dark:text-gray-200 mb-6 leading-relaxed">
                        "{{ $testimonial->quote }}"
                    </p>

                    {{-- Client Info --}}
                    <div class="testimonial-author flex items-center">
                        {{-- Avatar --}}
                        @if($testimonial->avatar)
                            <img src="{{ asset('storage/' . $testimonial->avatar) }}"
                                 alt="{{ $testimonial->name }}"
                                 class="testimonial-avatar"
                                 loading="lazy">
                        @else
                            <div class="testimonial-avatar-fallback">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif

                        <div class="ml-4">
                            <h4 class="font-bold text-gray-900 dark:text-white">{{ $testimonial->name }}</h4>
                            @if($testimonial->role)
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $testimonial->role }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Verified Badge (optional decoration) --}}
                    <div class="testimonial-verified">
                        <i class="fas fa-check-circle text-blue-600 dark:text-blue-400"></i>
                        <span class="text-xs text-gray-600 dark:text-gray-400 ml-1">Verified Client</span>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-comment-slash text-gray-400 text-6xl mb-4"></i>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">Belum ada testimoni yang ditambahkan.</p>
                        <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">Jadilah klien pertama yang memberikan testimoni!</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- CTA for testimonials --}}
        @if(count($testimonials ?? []) > 0)
            <div class="text-center mt-16 animate-on-scroll">
                <p class="text-gray-700 dark:text-gray-300 text-lg mb-6">
                    Ingin bergabung dengan klien-klien puas kami?
                </p>
                <a href="#kontak"
                   class="inline-block px-8 py-4 bg-blue-600 text-white rounded-full font-bold text-lg hover:bg-blue-700 transition transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i class="fas fa-rocket mr-2"></i> Mulai Project Anda
                </a>
            </div>
        @endif
    </div>
</section>
