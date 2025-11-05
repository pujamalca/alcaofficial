<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\PortfolioItem;
use App\Models\PricingPlan;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\CompanyStat;
use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data
        Service::query()->delete();
        PortfolioItem::query()->delete();
        PricingPlan::query()->delete();
        Testimonial::query()->delete();
        Faq::query()->delete();
        CompanyStat::query()->delete();

        // Seed Services
        $this->seedServices();

        // Seed Portfolio Items
        $this->seedPortfolio();

        // Seed Pricing Plans
        $this->seedPricing();

        // Seed Testimonials
        $this->seedTestimonials();

        // Seed FAQs
        $this->seedFaqs();

        // Seed Company Stats
        $this->seedCompanyStats();

        $this->command->info('✅ Landing Page content seeded successfully!');
    }

    private function seedServices(): void
    {
        $services = [
            [
                'title' => 'Website Company Profile',
                'description' => 'Website profesional untuk memperkenalkan perusahaan Anda dengan desain modern dan informasi lengkap tentang bisnis.',
                'icon' => 'fas fa-laptop-code',
                'features' => [
                    ['feature' => 'Design Modern & Professional'],
                    ['feature' => 'Responsive Semua Device'],
                    ['feature' => 'SEO Optimized'],
                    ['feature' => 'Fast Loading Speed']
                ],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'E-Commerce & Toko Online',
                'description' => 'Platform toko online lengkap dengan sistem pembayaran, manajemen produk, dan tracking pesanan real-time.',
                'icon' => 'fas fa-shopping-cart',
                'features' => [
                    ['feature' => 'Payment Gateway Integration'],
                    ['feature' => 'Product Management System'],
                    ['feature' => 'Order Tracking'],
                    ['feature' => 'Multi Vendor Support']
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Landing Page',
                'description' => 'Halaman landing page yang fokus untuk meningkatkan konversi dan penjualan produk atau layanan Anda.',
                'icon' => 'fas fa-rocket',
                'features' => [
                    ['feature' => 'High Conversion Design'],
                    ['feature' => 'Call-to-Action Optimization'],
                    ['feature' => 'Analytics Integration'],
                    ['feature' => 'A/B Testing Ready']
                ],
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        $this->command->info('✅ Services seeded');
    }

    private function seedPortfolio(): void
    {
        $portfolios = [
            [
                'title' => 'Toko Fashion Premium',
                'category' => 'E-Commerce',
                'description' => 'Platform e-commerce dengan 10,000+ produk, payment gateway terintegrasi, dan live tracking pesanan',
                'images' => [],
                'url' => '#',
                'rating' => 4.9,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Sistem Manajemen Sekolah',
                'category' => 'Web Development',
                'description' => 'Platform lengkap untuk manajemen akademik, absensi, nilai, dan pembayaran online',
                'images' => [],
                'url' => '#',
                'rating' => 5.0,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Aplikasi Delivery Food',
                'category' => 'Mobile App',
                'description' => 'Aplikasi pesan antar makanan dengan real-time GPS tracking dan notifikasi push',
                'images' => [],
                'url' => '#',
                'rating' => 4.8,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Brand Identity Startup Tech',
                'category' => 'Branding & Identity',
                'description' => 'Logo design, brand guidelines, dan visual identity lengkap untuk startup teknologi',
                'images' => [],
                'url' => '#',
                'rating' => 4.7,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Landing Page Kampanye Digital',
                'category' => 'Landing Page',
                'description' => 'High-converting landing page dengan A/B testing dan analytics integration',
                'images' => [],
                'url' => '#',
                'rating' => 4.9,
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            PortfolioItem::create($portfolio);
        }

        $this->command->info('✅ Portfolio items seeded');
    }

    private function seedPricing(): void
    {
        $pricingPlans = [
            [
                'name' => 'Starter',
                'price' => 'Rp 500K',
                'price_suffix' => 'Per Project',
                'badge' => null,
                'is_featured' => false,
                'description' => 'Perfect untuk pemula yang ingin memulai online presence',
                'cta_text' => 'Mulai Sekarang',
                'cta_url' => '#kontak',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Professional',
                'price' => 'Rp 2,5jt',
                'price_suffix' => 'Per Project',
                'badge' => 'Terpopuler',
                'is_featured' => true,
                'description' => 'Untuk bisnis yang ingin berkembang dengan fitur lengkap',
                'cta_text' => 'Mulai Sekarang',
                'cta_url' => '#kontak',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Enterprise',
                'price' => 'Custom',
                'price_suffix' => 'Hubungi Kami',
                'badge' => null,
                'is_featured' => false,
                'description' => 'Solusi custom untuk perusahaan besar dengan kebutuhan khusus',
                'cta_text' => 'Hubungi Kami',
                'cta_url' => '#kontak',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($pricingPlans as $plan) {
            PricingPlan::create($plan);
        }

        $this->command->info('✅ Pricing plans seeded');
    }

    private function seedTestimonials(): void
    {
        $testimonials = [
            [
                'name' => 'Budi Santoso',
                'role' => 'CEO PT Maju Jaya',
                'quote' => 'Sangat puas dengan hasil website yang dibuat. Tim sangat profesional, responsif, dan hasilnya melebihi ekspektasi. Website kami sekarang loading cepat dan tampilannya sangat modern!',
                'rating' => 5.0,
                'avatar' => null,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'role' => 'Owner Fashion Store',
                'quote' => 'E-commerce yang dibuat sangat membantu bisnis saya berkembang. Sejak menggunakan website ini, penjualan meningkat 300%! Highly recommended untuk yang mau bikin toko online.',
                'rating' => 5.0,
                'avatar' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Ahmad Rizki',
                'role' => 'Direktur Yayasan Pendidikan',
                'quote' => 'Sistem manajemen sekolah yang dibuat sangat memudahkan administrasi kami. Fitur-fiturnya lengkap dan mudah digunakan. Great job!',
                'rating' => 5.0,
                'avatar' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        $this->command->info('✅ Testimonials seeded');
    }

    private function seedFaqs(): void
    {
        $faqs = [
            [
                'question' => 'Berapa lama waktu pengerjaan website?',
                'answer' => 'Waktu pengerjaan bervariasi tergantung kompleksitas project. Untuk landing page sederhana sekitar 7-14 hari, company profile 14-30 hari, dan e-commerce 30-60 hari.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah bisa request fitur custom?',
                'answer' => 'Tentu saja! Kami sangat terbuka untuk request fitur custom sesuai kebutuhan bisnis Anda. Tim kami akan membantu mewujudkan semua kebutuhan fitur yang Anda inginkan.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah ada garansi revisi?',
                'answer' => 'Ya, kami memberikan unlimited revisi selama masa development. Setelah project selesai, kami juga memberikan support gratis untuk perbaikan bug atau masalah teknis.',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }

        $this->command->info('✅ FAQs seeded');
    }

    private function seedCompanyStats(): void
    {
        $stats = [
            [
                'label' => 'Project Selesai',
                'value' => '1250+',
                'icon' => 'fas fa-check-circle',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'label' => 'Klien Puas',
                'value' => '950+',
                'icon' => 'fas fa-users',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'label' => 'Tingkat Kepuasan',
                'value' => '4.9/5',
                'icon' => 'fas fa-star',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'label' => 'Support Available',
                'value' => '100%',
                'icon' => 'fas fa-headset',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            CompanyStat::create($stat);
        }

        $this->command->info('✅ Company stats seeded');
    }
}
