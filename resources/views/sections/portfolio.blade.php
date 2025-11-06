@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

{{-- Portfolio Section --}}
<section id="portofolio" class="section section-muted section-overlay">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20 animate-on-scroll">
            <span class="badge mb-4">
                <i class="fas fa-briefcase mr-2"></i> Portfolio Kami
            </span>
            <h2 class="section-title">Karya Terbaik Kami</h2>
            <p class="section-subtitle">Lebih dari 1250+ project sukses yang telah kami selesaikan dengan kepuasan klien</p>
        </div>

        {{-- Portfolio Filter --}}
        @php
            $categories = collect($portfolios ?? [])->pluck('category')->unique()->filter()->values()->all();
        @endphp

        @if(count($categories) > 0)
            <div class="flex flex-wrap justify-center gap-4 mb-12 animate-on-scroll">
                <button class="portfolio-filter-btn active px-6 py-3 rounded-full font-bold transition-all bg-blue-600 text-white hover:shadow-lg"
                        data-filter="all">
                    Semua
                </button>
                @foreach($categories as $category)
                    <button class="portfolio-filter-btn px-6 py-3 rounded-full font-bold transition-all border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white dark:text-blue-400 dark:border-blue-400 dark:hover:bg-blue-600 dark:hover:text-white"
                            data-filter="{{ strtolower($category) }}">
                        {{ ucfirst($category) }}
                    </button>
                @endforeach
            </div>
        @endif

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($portfolios ?? [] as $portfolio)
                <div class="portfolio-card portfolio-item animate-on-scroll"
                     data-category="{{ strtolower($portfolio->category ?? 'other') }}">
                    @php
                        $portfolioImage = null;
                        if ($portfolio->header_image) {
                            $portfolioImage = Str::startsWith($portfolio->header_image, ['http://', 'https://'])
                                ? $portfolio->header_image
                                : Storage::url($portfolio->header_image);
                        } elseif (!empty($portfolio->images)) {
                            $firstImage = is_array($portfolio->images) ? ($portfolio->images[0] ?? null) : null;
                            if ($firstImage) {
                                $portfolioImage = Str::startsWith($firstImage, ['http://', 'https://'])
                                    ? $firstImage
                                    : Storage::url($firstImage);
                            }
                        }
                    @endphp
                    @if($portfolioImage)
                        <img src="{{ $portfolioImage }}"
                             alt="{{ $portfolio->title }}"
                             class="w-full h-64 object-cover"
                             loading="lazy">
                    @else
                        <div class="w-full h-64 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <i class="fas fa-image text-white text-6xl opacity-50"></i>
                        </div>
                    @endif

                    <div class="p-6">
                        @if($portfolio->category)
                            <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 text-sm rounded-full font-bold">
                                {{ ucfirst($portfolio->category) }}
                            </span>
                        @endif

                        <h3 class="text-2xl font-bold mt-4 mb-2">{{ $portfolio->title }}</h3>
                        <p class="text-gray-600 dark:text-white mb-4">
                            {{ Str::limit($portfolio->description, 100) }}
                        </p>

                        <div class="flex items-center justify-between">
                            {{-- Star Rating --}}
                            <div class="flex items-center text-yellow-500">
                                @php
                                    $rating = $portfolio->rating ?? 0;
                                    $fullStars = floor($rating);
                                    $hasHalfStar = ($rating - $fullStars) >= 0.5;
                                @endphp

                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $fullStars)
                                        <i class="fas fa-star"></i>
                                    @elseif($i == $fullStars + 1 && $hasHalfStar)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span class="ml-2 font-semibold text-gray-700 dark:text-white">{{ number_format($rating, 1) }}/5</span>
                            </div>

                            <a href="{{ route('portfolio.show', $portfolio->slug) }}"
                               class="text-blue-600 dark:text-blue-400 font-bold hover:underline">
                                Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="portfolio-overlay">
                        <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="btn-primary">
                            <i class="fas fa-eye mr-2"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600 dark:text-gray-400">Belum ada portfolio yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
