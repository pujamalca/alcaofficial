{{-- Contact Section --}}
<section id="kontak" class="section section-gradient">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20 animate-on-scroll">
            <span class="badge mb-4">
                <i class="fas fa-envelope mr-2"></i> Hubungi Kami
            </span>
            <h2 class="section-title">Mari Wujudkan Website Impian Anda</h2>
            <p class="section-subtitle">Kami siap membantu mewujudkan website terbaik untuk bisnis Anda. Hubungi kami sekarang!</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            {{-- Contact Info Cards --}}
            <div class="lg:col-span-1 space-y-6">
                @forelse($contactCards ?? [] as $card)
                    <div class="contact-info-card animate-on-scroll">
                        <div class="contact-info-icon">
                            <i class="{{ $card->icon }}"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $card->title }}</h3>
                            @if($card->link)
                                <a href="{{ $card->link }}" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline" target="_blank">
                                    {{ $card->value }}
                                </a>
                            @else
                                <p class="text-gray-700 dark:text-gray-200 font-semibold">{{ $card->value }}</p>
                            @endif
                            @if($card->description)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $card->description }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    {{-- Default contact cards if database is empty --}}
                    <div class="contact-info-card animate-on-scroll">
                        <div class="contact-info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Email</h3>
                            <a href="mailto:info@alcaofficial.com" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline">
                                info@alcaofficial.com
                            </a>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Kirim email kapan saja</p>
                        </div>
                    </div>

                    <div class="contact-info-card animate-on-scroll">
                        <div class="contact-info-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">WhatsApp</h3>
                            <a href="https://wa.me/6288101018577" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline" target="_blank">
                                +62 881-0101-8577
                            </a>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Chat langsung dengan kami</p>
                        </div>
                    </div>

                    <div class="contact-info-card animate-on-scroll">
                        <div class="contact-info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-info-content">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Lokasi</h3>
                            <p class="text-gray-700 dark:text-gray-200 font-semibold">Jakarta, Indonesia</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Melayani seluruh Indonesia</p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-2">
                <div class="contact-form-container animate-on-scroll">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Kirim Pesan</h3>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success mb-6">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if(session('error'))
                        <div class="alert alert-error mb-6">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6" id="contactForm">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf-token-input">

                        <div class="grid md:grid-cols-2 gap-6">
                            {{-- Name Field --}}
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="form-input @error('name') is-invalid @enderror"
                                       placeholder="Masukkan nama Anda"
                                       required>
                                @error('name')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Email Field --}}
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-input @error('email') is-invalid @enderror"
                                       placeholder="nama@email.com"
                                       required>
                                @error('email')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            {{-- Phone Field --}}
                            <div class="form-group">
                                <label for="phone" class="form-label">
                                    No. Telepon/WhatsApp
                                </label>
                                <input type="tel"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       class="form-input @error('phone') is-invalid @enderror"
                                       placeholder="+62 812-3456-7890">
                                @error('phone')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Subject Field --}}
                            <div class="form-group">
                                <label for="subject" class="form-label">
                                    Subjek <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="subject"
                                       name="subject"
                                       value="{{ old('subject') }}"
                                       class="form-input @error('subject') is-invalid @enderror"
                                       placeholder="Topik pesan Anda"
                                       required>
                                @error('subject')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Message Field --}}
                        <div class="form-group">
                            <label for="message" class="form-label">
                                Pesan <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message"
                                      name="message"
                                      rows="6"
                                      class="form-input @error('message') is-invalid @enderror"
                                      placeholder="Ceritakan kebutuhan website Anda..."
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div>
                            <button type="submit" class="btn-primary w-full md:w-auto">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
