{{-- Footer Section --}}
<footer class="footer bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Main Footer Content --}}
        <div class="footer-content grid md:grid-cols-2 lg:grid-cols-4 gap-12 pb-12 border-b border-gray-800">
            {{-- Company Info --}}
            <div class="footer-col">
                <div class="footer-logo mb-6">
                    <img src="{{ asset('alca.webp') }}"
                         alt="{{ config('app.name', 'AlcaOfficial') }}"
                         class="h-12">
                </div>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Jasa pembuatan website professional terbaik di Indonesia. Kami membantu bisnis Anda berkembang dengan solusi digital terkini.
                </p>
                <div class="flex space-x-4">
                    <a href="https://facebook.com/alcaofficial" target="_blank" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://instagram.com/alcaofficial" target="_blank" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://twitter.com/alcaofficial" target="_blank" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://linkedin.com/company/alcaofficial" target="_blank" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://github.com/alcaofficial" target="_blank" class="social-icon">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="footer-col">
                <h3 class="footer-heading">Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ route('services.index') }}">Layanan</a></li>
                    <li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('source-codes.index') }}">Source Code</a></li>
                    <li><a href="{{ url('/#kontak') }}">Kontak</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div class="footer-col">
                <h3 class="footer-heading">Layanan Kami</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('services.index') }}">Website Company Profile</a></li>
                    <li><a href="{{ route('services.index') }}">Toko Online / E-Commerce</a></li>
                    <li><a href="{{ route('services.index') }}">Landing Page</a></li>
                    <li><a href="{{ route('services.index') }}">Website Sekolah</a></li>
                    <li><a href="{{ route('services.index') }}">Aplikasi Web Custom</a></li>
                    <li><a href="{{ route('services.index') }}">Maintenance & Support</a></li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="footer-col">
                <h3 class="footer-heading">Hubungi Kami</h3>
                <ul class="footer-contact">
                    <li>
                        <i class="fas fa-envelope mr-3 text-blue-400"></i>
                        <a href="mailto:info@alcaofficial.com" class="hover:text-blue-400 transition">info@alcaofficial.com</a>
                    </li>
                    <li>
                        <i class="fab fa-whatsapp mr-3 text-green-400"></i>
                        <a href="https://wa.me/6288101018577" target="_blank" class="hover:text-green-400 transition">+62 881-0101-8577</a>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt mr-3 text-red-400"></i>
                        <span>Jakarta, Indonesia</span>
                    </li>
                    <li>
                        <i class="fas fa-clock mr-3 text-yellow-400"></i>
                        <span>Senin - Sabtu: 09:00 - 18:00</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div class="footer-bottom py-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400 text-sm text-center md:text-left">
                    &copy; {{ date('Y') }} <span class="font-bold text-blue-400">{{ config('app.name', 'AlcaOfficial') }}</span>.
                    All rights reserved.
                </p>
                <div class="flex flex-wrap justify-center gap-6 text-sm">
                    <a href="/pages/privacy-policy" class="text-gray-400 hover:text-blue-400 transition">Privacy Policy</a>
                    <a href="/pages/terms-of-service" class="text-gray-400 hover:text-blue-400 transition">Terms of Service</a>
                    <a href="/pages/sitemap" class="text-gray-400 hover:text-blue-400 transition">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>
