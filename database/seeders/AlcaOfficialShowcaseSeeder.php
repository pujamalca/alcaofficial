<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\Tag;
use App\Models\Testimonial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AlcaOfficialShowcaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedServices();
        $this->seedPortfolio();
        $this->seedTestimonials();
        $this->seedBlog();

        $this->command?->info('✅ Konten showcase AlcaOfficial berhasil di-seed.');
    }

    private function seedServices(): void
    {
        $services = [
            [
                'title' => 'Website Company Profile Premium',
                'icon' => 'fas fa-building',
                'description' => 'Bangun kredibilitas perusahaan dengan website profesional, detail layanan, dan halaman tim yang meyakinkan.',
                'content' => 'Website company profile kami dirancang untuk memperkuat brand image, memudahkan calon klien mengenal bisnis Anda, serta mengoptimalkan jalur konversi melalui call-to-action yang jelas dan formulir prospek.',
                'features' => [
                    'Desain tailor-made sesuai brand guideline',
                    'Halaman profil, layanan, portofolio, dan testimoni lengkap',
                    'Integrasi WhatsApp, email, dan formulir prospek',
                    'Optimasi SEO on-page dan kecepatan loading',
                ],
                'benefits' => [
                    'Meningkatkan kepercayaan calon pelanggan',
                    'Mempermudah tim sales menerima lead terukur',
                    'Siap dikembangkan menjadi blog atau pusat dokumentasi',
                ],
            ],
            [
                'title' => 'Landing Page Penjualan',
                'icon' => 'fas fa-rocket',
                'description' => 'Landing page fokus konversi dengan copywriting tajam, elemen social proof, dan tracking campaign lengkap.',
                'content' => 'Landing page kami dirancang berdasarkan data campaign yang telah terbukti menaikkan konversi. Setiap blok konten dipetakan agar alur ceritanya runut, memperkuat urgensi, dan mendorong pengunjung untuk melakukan aksi.',
                'features' => [
                    'Copywriting conversion-based & CTA strategis',
                    'Countdown timer, form lead, dan integrasi payment',
                    'Integrasi Meta Pixel, Google Analytics 4 & Tag Manager',
                    'A/B testing siap pakai dan optimal di mobile',
                ],
                'benefits' => [
                    'Konversi campaign lebih terukur dan stabil',
                    'Pengunjung fokus ke satu aksi utama',
                    'Cocok untuk promosi webinar, produk digital, dan event',
                ],
            ],
            [
                'title' => 'E-Commerce & Toko Online',
                'icon' => 'fas fa-shopping-bag',
                'description' => 'Platform e-commerce lengkap dengan katalog produk, manajemen stok, integrasi pengiriman, dan payment gateway.',
                'content' => 'Kami membangun sistem toko online yang mudah dioperasikan, punya modul promosi, serta siap scale-up. Pengelolaan produk, stok, hingga laporan penjualan dapat diakses dari dashboard yang intuitif.',
                'features' => [
                    'Integrasi Midtrans, Xendit, dan pembayaran COD',
                    'Atur varian produk, flash sale, voucher & loyalty point',
                    'Integrasi logistik (RajaOngkir, Shipper, Deliveree)',
                    'Dashboard laporan penjualan real-time',
                ],
                'benefits' => [
                    'Mempercepat otomasi penjualan dan fulfillment',
                    'Skalabilitas tinggi untuk ribuan produk',
                    'Mudah diintegrasikan dengan marketplace & CRM',
                ],
            ],
            [
                'title' => 'Custom Web Application',
                'icon' => 'fas fa-layer-group',
                'description' => 'Bangun sistem internal, dashboard, dan aplikasi web kustom yang mendukung operasional bisnis Anda.',
                'content' => 'Tim kami berpengalaman mengembangkan sistem ERP mini, dashboard laporan, hingga aplikasi multi-tenant. Setiap modul dikembangkan berdasarkan business process yang sudah dipetakan bersama tim Anda.',
                'features' => [
                    'Analisis kebutuhan dan pendampingan workflow',
                    'Arsitektur terukur dengan Laravel & RESTful API',
                    'Role & permission management yang fleksibel',
                    'Monitoring kinerja, audit log, dan backup otomatis',
                ],
                'benefits' => [
                    'Solusi tepat guna sesuai proses bisnis',
                    'Bisa diintegrasikan dengan aplikasi yang sudah ada',
                    'Keamanan terjamin dengan standar OWASP',
                ],
            ],
            [
                'title' => 'Website Instansi & Pemerintahan',
                'icon' => 'fas fa-landmark',
                'description' => 'Portal informasi resmi untuk instansi pemerintah dengan fitur berita, agenda, dokumen publik, dan aksesibilitas tinggi.',
                'content' => 'Website instansi kami memenuhi standar kemudahan akses, struktur informasi yang jelas, hingga kebutuhan dokumentasi publik. Tersedia modul berita, agenda, galeri, dan publikasi dokumen resmi.',
                'features' => [
                    'Struktur navigasi sesuai standar SPBE dan PPID',
                    'Sistem berita, agenda, dan download dokumen',
                    'Integrasi kanal aduan & tracking layanan publik',
                    'Desain aksesibel (WCAG friendly) dan multi bahasa',
                ],
                'benefits' => [
                    'Transparansi informasi ke masyarakat meningkat',
                    'Mempermudah pengelolaan berita dan dokumen',
                    'Keamanan dan backup sesuai standar pemerintah',
                ],
            ],
            [
                'title' => 'Maintenance & Website Optimization',
                'icon' => 'fas fa-tools',
                'description' => 'Jaga performa website tetap prima dengan layanan maintenance berkala, monitoring keamanan, dan optimasi kecepatan.',
                'content' => 'Kami menyediakan paket maintenance mencakup update keamanan, backup terjadwal, audit kecepatan, serta perbaikan bug. Layanan ini mendukung berbagai stack seperti Laravel, WordPress, dan custom app.',
                'features' => [
                    'Monitoring uptime & error alert 24/7',
                    'Update framework & patch keamanan terbaru',
                    'Backup otomatis ke cloud storage',
                    'Audit SEO teknis & optimasi Core Web Vitals',
                ],
                'benefits' => [
                    'Website lebih aman dari celah keamanan',
                    'Kinerja tetap optimal seiring pertumbuhan traffic',
                    'Tim internal fokus pada pengembangan bisnis',
                ],
            ],
        ];

        $desiredSlugs = [];

        foreach ($services as $index => $service) {
            $slug = Str::slug($service['title']);
            $desiredSlugs[] = $slug;

            Service::updateOrCreate(
                ['slug' => $slug],
                array_merge($service, [
                    'slug' => $slug,
                    'sort_order' => ($index + 1) * 10,
                    'is_active' => true,
                ])
            );
        }

        Service::whereNotIn('slug', $desiredSlugs)->delete();

        $this->command?->info('• Data layanan diperbarui mengikuti katalog AlcaOfficial.');
    }

    private function seedPortfolio(): void
    {
        $portfolioItems = [
            [
                'title' => 'BPRS Hikmah Wakilah',
                'category' => 'Fintech & Banking',
                'description' => 'Website resmi lembaga keuangan syariah dengan simulasi pembiayaan, informasi produk, dan integrasi WhatsApp Business.',
                'client_name' => 'PT BPRS Hikmah Wakilah',
                'project_date' => Carbon::parse('2024-02-10'),
                'technologies' => ['Laravel', 'Tailwind CSS', 'Livewire', 'MySQL'],
                'images' => [
                    'https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=1200&q=80',
                    'https://images.unsplash.com/photo-1556740749-887f6717d7e4?auto=format&fit=crop&w=1200&q=80',
                ],
                'url' => 'https://hikmahwakilah.co.id',
                'rating' => 5.0,
            ],
            [
                'title' => 'KawanStudio Creative Agency',
                'category' => 'Agency Website',
                'description' => 'Website portofolio agensi kreatif dengan showcase proyek, studi kasus interaktif, dan sistem booking meeting otomatis.',
                'client_name' => 'KawanStudio',
                'project_date' => Carbon::parse('2023-11-05'),
                'technologies' => ['Laravel', 'Inertia.js', 'Vue.js', 'Tailwind CSS'],
                'images' => [
                    'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80',
                ],
                'url' => 'https://kawanstudio.id',
                'rating' => 4.9,
            ],
            [
                'title' => 'Venturo Coworking Hub',
                'category' => 'Landing Page',
                'description' => 'Landing page premium untuk coworking space lengkap dengan virtual tour, jadwal event, dan sistem booking ruangan.',
                'client_name' => 'Venturo Hub Jakarta',
                'project_date' => Carbon::parse('2024-03-20'),
                'technologies' => ['Laravel', 'Alpine.js', 'Swiper.js'],
                'images' => [
                    'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1200&q=80',
                ],
                'url' => 'https://venturohub.id',
                'rating' => 4.8,
            ],
            [
                'title' => 'EduPrime Learning Management',
                'category' => 'Education Platform',
                'description' => 'Platform e-learning lengkap dengan modul kelas live, bank soal, sertifikat otomatis, dan dashboard mentor.',
                'client_name' => 'EduPrime Indonesia',
                'project_date' => Carbon::parse('2023-08-12'),
                'technologies' => ['Laravel', 'Livewire', 'Redis', 'MySQL'],
                'images' => [
                    'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=1200&q=80',
                ],
                'url' => 'https://eduprime.id',
                'rating' => 5.0,
            ],
            [
                'title' => 'LinkAja! Syariah Campaign',
                'category' => 'Campaign Microsite',
                'description' => 'Microsite promo kampanye dompet digital dengan progress target donasi, leaderboard komunitas, dan integrasi API internal.',
                'client_name' => 'LinkAja Syariah',
                'project_date' => Carbon::parse('2024-04-15'),
                'technologies' => ['Laravel', 'Tailwind CSS', 'REST API'],
                'images' => [
                    'https://images.unsplash.com/photo-1556740749-887f6717d7e4?auto=format&fit=crop&w=1200&q=80',
                ],
                'url' => 'https://syariah.linkaja.id',
                'rating' => 4.9,
            ],
            [
                'title' => 'Rumah Sakit Harapan Bunda',
                'category' => 'Healthcare',
                'description' => 'Website rumah sakit dengan jadwal dokter, sistem pendaftaran online, dan edukasi kesehatan untuk pasien.',
                'client_name' => 'RS Harapan Bunda',
                'project_date' => Carbon::parse('2024-01-08'),
                'technologies' => ['Laravel', 'Tailwind CSS', 'FilamentPHP'],
                'images' => [
                    'https://images.unsplash.com/photo-1587502537745-84b86da1204d?auto=format&fit=crop&w=1200&q=80',
                ],
                'url' => 'https://rsharapanbunda.id',
                'rating' => 4.8,
            ],
        ];

        $desiredSlugs = [];

        foreach ($portfolioItems as $index => $item) {
            $slug = Str::slug($item['title']);
            $desiredSlugs[] = $slug;

            PortfolioItem::updateOrCreate(
                ['slug' => $slug],
                array_merge($item, [
                    'slug' => $slug,
                    'header_image' => $item['images'][0] ?? null,
                    'sort_order' => ($index + 1) * 10,
                    'is_active' => true,
                ])
            );
        }

        PortfolioItem::whereNotIn('slug', $desiredSlugs)->delete();

        $this->command?->info('• Data portofolio diperbarui menyerupai proyek utama AlcaOfficial.');
    }

    private function seedTestimonials(): void
    {
        $testimonials = [
            [
                'name' => 'Rizky Fadillah',
                'role' => 'Founder KawanStudio',
                'rating' => 5,
                'quote' => 'Tim AlcaOfficial sangat detail dan komunikatif. Landing page campaign kami berhasil meningkatkan jumlah leads 3x lipat dalam dua minggu pertama.',
            ],
            [
                'name' => 'Salsabila Putri',
                'role' => 'Marketing Manager BPRS Hikmah Wakilah',
                'rating' => 4.9,
                'quote' => 'Website baru membuat nasabah lebih mudah menemukan informasi produk. Integrasi WhatsApp dan simulasi pembiayaan sangat membantu tim sales kami.',
            ],
            [
                'name' => 'David Gunawan',
                'role' => 'CEO Venturo Coworking',
                'rating' => 5,
                'quote' => 'Microsite event kami tampil sangat profesional. Tim AlcaOfficial memberikan insight yang tepat tentang struktur konten dan copywriting.',
            ],
            [
                'name' => 'Nur Aisyah',
                'role' => 'Direktur EduPrime',
                'rating' => 4.8,
                'quote' => 'Platform e-learning kami sekarang lebih stabil dan mudah digunakan mentor. Reporting dan fitur sertifikat otomatisnya sangat membantu.',
            ],
        ];

        $desiredOrder = [];

        foreach ($testimonials as $index => $testimonial) {
            $desiredOrder[] = $testimonial['name'];
            Testimonial::updateOrCreate(
                ['name' => $testimonial['name']],
                array_merge($testimonial, [
                    'sort_order' => ($index + 1) * 10,
                    'is_active' => true,
                ])
            );
        }

        Testimonial::whereNotIn('name', $desiredOrder)->delete();

        $this->command?->info('• Testimoni klien diperbarui.');
    }

    private function seedBlog(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('post_tag')->truncate();
        Comment::query()->withTrashed()->forceDelete();
        Post::query()->withTrashed()->forceDelete();
        Tag::query()->truncate();

        // Keep existing categories created manually, but refresh ones used for blog
        $categoryDefinitions = [
            'strategi-website' => [
                'name' => 'Strategi Website',
                'description' => 'Tips dan strategi membangun website profesional untuk berbagai kebutuhan bisnis.',
                'icon' => 'heroicon-o-light-bulb',
                'color' => '#1D4ED8',
            ],
            'digital-marketing' => [
                'name' => 'Digital Marketing',
                'description' => 'Bahas strategi kampanye digital, optimasi konversi, dan iklan berbayar.',
                'icon' => 'heroicon-o-chart-bar',
                'color' => '#2563EB',
            ],
            'seo-conversion' => [
                'name' => 'SEO & Conversion',
                'description' => 'Panduan SEO teknis, copywriting, dan optimasi landing page.',
                'icon' => 'heroicon-o-sparkles',
                'color' => '#0EA5E9',
            ],
            'bisnis-branding' => [
                'name' => 'Bisnis & Branding',
                'description' => 'Insight branding, storytelling, dan pengembangan bisnis digital.',
                'icon' => 'heroicon-o-briefcase',
                'color' => '#14B8A6',
            ],
        ];

        $categoryIds = [];
        $order = 10;
        foreach ($categoryDefinitions as $slug => $data) {
            $category = Category::updateOrCreate(
                ['slug' => $slug],
                array_merge($data, [
                    'slug' => $slug,
                    'sort_order' => $order,
                    'is_featured' => true,
                    'is_active' => true,
                ])
            );

            $categoryIds[$slug] = $category->id;
            $order += 10;
        }

        $tagNames = [
            'Jasa Website', 'Landing Page', 'UX Writing', 'SEO', 'Google Ads',
            'Copywriting', 'Branding', 'UMKM Digital', 'E-Commerce', 'Tips Bisnis',
        ];

        $tagIds = [];
        foreach ($tagNames as $tag) {
            $tagModel = Tag::updateOrCreate(
                ['slug' => Str::slug($tag)],
                ['name' => $tag]
            );
            $tagIds[$tag] = $tagModel->id;
        }

        Schema::enableForeignKeyConstraints();

        $author = User::where('email', 'admin@example.com')->first()
            ?? User::first()
            ?? User::factory()->create([
                'name' => 'Tim AlcaOfficial',
                'email' => 'team@alcaofficial.com',
            ]);

        $posts = [
            [
                'title' => '5 Tips Memilih Jasa Pembuatan Website Profesional untuk Bisnis Anda',
                'category_slug' => 'strategi-website',
                'featured_image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Bagaimana memilih partner pengembang website yang tepat? Berikut lima indikator penting agar investasi digital Anda menghasilkan.',
                'content' => <<<HTML
<p>Membangun website bukan hanya soal tampilan, melainkan bagaimana menghadirkan pengalaman digital yang mewakili brand Anda. Jasa pembuatan website profesional akan membantu memetakan tujuan bisnis, menyusun informasi, hingga memastikan kecepatan dan keamanan.</p>
<p>Pastikan Anda mengecek portofolio yang relevan, memahami proses kerja tim, menilai cara mereka mengukur hasil, serta menanyakan dukungan pasca peluncuran. Jangan lupa, pilih partner yang mau berdiskusi mendalam tentang model bisnis Anda.</p>
<p>Tim AlcaOfficial selalu memulai project dengan discovery workshop, audit aset digital, dan menyusun roadmap pengembangan agar setiap fitur yang dibangun benar-benar berdampak.</p>
HTML,
                'tags' => ['Jasa Website', 'Tips Bisnis', 'Branding'],
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(21),
            ],
            [
                'title' => 'Kenapa Landing Page Premium Bisa Meningkatkan Konversi hingga 3x Lipat?',
                'category_slug' => 'digital-marketing',
                'featured_image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Landing page dengan copywriting dan struktur yang tepat terbukti menaikkan rasio konversi campaign digital. Berikut framework yang kami gunakan.',
                'content' => <<<HTML
<p>Landing page yang efektif dibangun dengan alur cerita yang jelas: headline yang kuat, penjelasan manfaat, social proof, dan call-to-action yang menonjol. Kami selalu memadukan data performa campaign dengan riset persona sehingga pesan yang disampaikan lebih personal.</p>
<p>Pada project LinkAja Syariah, kami melakukan eksperimen terhadap 3 variasi hero section dan CTA. Hasilnya, kombinasi headline berorientasi manfaat dengan CTA berbentuk tombol floating menghasilkan konversi 3,2x lebih tinggi dibanding versi awal.</p>
<p>Jangan lupa menyiapkan sistem tracking yang rapi. Integrasi Google Tag Manager, Meta Pixel, dan server-side tracking memastikan setiap interaksi tercatat untuk dianalisis.</p>
HTML,
                'tags' => ['Landing Page', 'Digital Marketing', 'Copywriting'],
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(14),
            ],
            [
                'title' => 'Checklist SEO On-Page yang Harus Dilakukan Setelah Launching Website',
                'category_slug' => 'seo-conversion',
                'featured_image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Optimasi SEO on-page menjadi pondasi agar website baru mudah ditemukan di mesin pencari. Kami merangkum checklist yang bisa langsung dieksekusi.',
                'content' => <<<HTML
<p>Mulailah dari struktur heading yang rapi dan penggunaan kata kunci natural pada judul serta meta description. Selanjutnya pastikan kecepatan website dengan kompresi aset, penggunaan CDN, dan lazy loading.</p>
<p>Jangan lupakan schema markup untuk jenis konten tertentu seperti FAQ, artikel, atau produk. Google akan lebih mudah memahami konten Anda sehingga peluang muncul di rich result semakin tinggi.</p>
<p>Terakhir, pastikan Anda sudah menyiapkan sitemap.xml, robots.txt, serta mendaftarkan website ke Google Search Console dan Bing Webmaster Tools untuk monitoring rutin.</p>
HTML,
                'tags' => ['SEO', 'Jasa Website', 'Tips Bisnis'],
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(9),
            ],
            [
                'title' => 'Cara Menyiapkan Konten Sebelum Launching Website Perusahaan',
                'category_slug' => 'bisnis-branding',
                'featured_image' => 'https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Konten yang solid akan membuat proses produksi website berjalan lancar. Berikut struktur konten yang biasa kami minta dari klien sebelum kickoff.',
                'content' => <<<HTML
<p>Mulailah dari pengumpulan brand guideline, profil perusahaan, layanan utama, dan keunggulan kompetitif. Siapkan juga foto tim, data portofolio, serta testimoni pelanggan untuk memperkuat social proof.</p>
<p>Untuk setiap layanan, tuliskan masalah yang diselesaikan, proses kerja, dan hasil yang akan didapat oleh klien. Struktur ini memudahkan kami merancang flow konten yang persuasif sekaligus mudah dipahami.</p>
<p>Terakhir, tentukan CTA utama yang ingin ditonjolkan—apakah booking konsultasi, mengisi formulir, atau mengunduh company profile. CTA yang jelas akan meningkatkan konversi sejak hari pertama website live.</p>
HTML,
                'tags' => ['Branding', 'Copywriting', 'Jasa Website'],
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(6),
            ],
            [
                'title' => 'Panduan Memilih Platform E-Commerce yang Tepat untuk UMKM',
                'category_slug' => 'strategi-website',
                'featured_image' => 'https://images.unsplash.com/photo-1515169067865-5387ec356754?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Setiap UMKM memiliki kebutuhan yang berbeda. Kenali plus minus berbagai platform sebelum berinvestasi pada toko online Anda.',
                'content' => <<<HTML
<p>Untuk UMKM yang baru mulai, solusi SaaS seperti Shopify atau WooCommerce bisa jadi pilihan cepat. Namun ketika kebutuhan integrasi stok dan CRM semakin kompleks, platform custom dengan Laravel jauh lebih fleksibel.</p>
<p>Pertimbangkan juga biaya jangka panjang, kemudahan customisasi, dukungan payment gateway lokal, serta kemampuan multi gudang. Kami biasa melakukan sesi discovery untuk memetakan alur operasional sebelum merekomendasikan platform terbaik.</p>
<p>Dengan fondasi yang tepat, toko online Anda siap melayani pelanggan di berbagai kanal dan terhubung dengan marketplace maupun sistem akuntansi internal.</p>
HTML,
                'tags' => ['E-Commerce', 'UMKM Digital', 'Tips Bisnis'],
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(3),
            ],
        ];

        foreach ($posts as $index => $data) {
            $slug = Str::slug($data['title']);
            $content = $data['content'];
            $readingTime = max(2, (int) ceil(str_word_count(strip_tags($content)) / 200));

            $post = Post::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $categoryIds[$data['category_slug']] ?? null,
                    'author_id' => $author->id,
                    'title' => $data['title'],
                    'excerpt' => $data['excerpt'],
                    'content' => $content,
                    'featured_image' => $data['featured_image'],
                    'type' => 'article',
                    'status' => 'published',
                    'published_at' => $data['published_at'],
                    'is_featured' => $data['is_featured'],
                    'is_sticky' => $index === 0,
                    'reading_time' => $readingTime,
                    'seo_title' => Str::limit($data['title'], 60, ''),
                    'seo_description' => Str::limit(strip_tags($data['excerpt']), 160, ''),
                    'metadata' => [
                        'hero_style' => 'gradient',
                        'call_to_action' => 'Hubungi kami untuk diskusi project.',
                    ],
                ]
            );

            $post->tags()->sync(
                collect($data['tags'])
                    ->map(fn (string $tag) => $tagIds[$tag] ?? null)
                    ->filter()
                    ->all()
            );
        }

        $this->command?->info('• Blog post, kategori, dan tag diselaraskan dengan konten AlcaOfficial.');
    }
}
