<?php

namespace Database\Seeders;

use App\Models\ContactCard;
use App\Models\PortfolioItem;
use App\Models\PricingFeature;
use App\Models\PricingPlan;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MarketingSeeder extends Seeder
{
    public function run(): void
    {
        $timestamp = Carbon::now()->toDateTimeString();

        if (Service::count() === 0) {
            Service::insert([
                [
                    'title' => 'Website Company Profile',
                    'icon' => 'heroicon-o-briefcase',
                    'description' => 'Website profesional untuk memperkenalkan perusahaan Anda dengan gaya modern dan informatif.',
                    'sort_order' => 10,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
                [
                    'title' => 'E-Commerce & Toko Online',
                    'icon' => 'heroicon-o-shopping-cart',
                    'description' => 'Solusi toko online lengkap dengan payment gateway, manajemen produk, dan pelacakan pesanan.',
                    'sort_order' => 20,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
                [
                    'title' => 'Landing Page Campaign',
                    'icon' => 'heroicon-o-rocket-launch',
                    'description' => 'Halaman konversi tinggi yang dirancang khusus untuk kampanye pemasaran digital Anda.',
                    'sort_order' => 30,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
                [
                    'title' => 'Portal Berita & Blog',
                    'icon' => 'heroicon-o-newspaper',
                    'description' => 'Portal konten dengan CMS lengkap, sistem kategori, komentar, dan integrasi media sosial.',
                    'sort_order' => 40,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
                [
                    'title' => 'Sistem Informasi Kustom',
                    'icon' => 'heroicon-o-cpu-chip',
                    'description' => 'Aplikasi web khusus untuk otomasi proses bisnis, dashboard, dan pelaporan real-time.',
                    'sort_order' => 50,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
                [
                    'title' => 'SEO & Digital Marketing',
                    'icon' => 'heroicon-o-chart-bar',
                    'description' => 'Optimasi mesin pencari, konten, dan strategi digital marketing untuk meningkatkan traffic.',
                    'sort_order' => 60,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
            ]);
        }

        if (PortfolioItem::count() === 0) {
            PortfolioItem::insert([
                [
                    'title' => 'PT Sukses Makmur',
                    'category' => 'Web Development',
                    'description' => 'Company profile dengan katalog produk digital dan formulir konsultasi.',
                    'sort_order' => 10,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
                [
                    'title' => 'BPR Nusantara Finance',
                    'category' => 'Web Development',
                    'description' => 'Website lembaga keuangan dengan simulasi kredit dan integrasi WhatsApp.',
                    'sort_order' => 20,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
                [
                    'title' => 'Fashionista Premium Store',
                    'category' => 'E-Commerce',
                    'description' => 'E-commerce fashion dengan membership, loyalty points, dan notifikasi pesanan.',
                    'sort_order' => 30,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
                [
                    'title' => 'Kuliner Nusantara',
                    'category' => 'E-Commerce',
                    'description' => 'Marketplace kuliner dengan integrasi kurir lokal dan sistem rating.',
                    'sort_order' => 40,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
                [
                    'title' => 'Event Tech Conference',
                    'category' => 'Landing Page',
                    'description' => 'Landing page event dengan integrasi pendaftaran, countdown, dan highlight pembicara.',
                    'sort_order' => 50,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
                [
                    'title' => 'EduTech Insight',
                    'category' => 'Dashboard & CMS',
                    'description' => 'Portal edukasi dengan multi-penulis, membership, dan integrasi newsletter.',
                    'sort_order' => 60,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ],
            ]);
        }

        if (PricingPlan::count() === 0) {
            $plans = [
                [
                    'name' => 'Starter',
                    'price' => 'Rp 500K',
                    'price_suffix' => 'Per project',
                    'badge' => 'Hemat',
                    'is_featured' => false,
                    'description' => 'Landing page profesional untuk UMKM dan personal branding.',
                    'cta_text' => 'Konsultasi',
                    'cta_url' => '#kontak',
                    'sort_order' => 10,
                    'features' => [
                        'Desain responsif & modern',
                        '1 halaman konversi',
                        'Integrasi WhatsApp CTA',
                        'Optimasi SEO dasar',
                    ],
                ],
                [
                    'name' => 'Business',
                    'price' => 'Rp 2,5jt',
                    'price_suffix' => 'Per project',
                    'badge' => 'Terpopuler',
                    'is_featured' => true,
                    'description' => 'Website bisnis lengkap dengan halaman layanan dan blog.',
                    'cta_text' => 'Diskusikan',
                    'cta_url' => '#kontak',
                    'sort_order' => 20,
                    'features' => [
                        'Desain custom eksklusif',
                        '5-7 halaman dinamis',
                        'Blog & manajemen konten',
                        'Integrasi Google Analytics',
                    ],
                ],
                [
                    'name' => 'Enterprise',
                    'price' => 'Rp 5jt+',
                    'price_suffix' => 'Per project',
                    'badge' => 'Kustom',
                    'is_featured' => false,
                    'description' => 'Solusi tailor-made untuk project korporasi dan startup.',
                    'cta_text' => 'Jadwalkan Meeting',
                    'cta_url' => '#kontak',
                    'sort_order' => 30,
                    'features' => [
                        'Analisis kebutuhan mendalam',
                        'Integrasi sistem internal',
                        'Tim support dedicated',
                        'Garansi & SLA premium',
                    ],
                ],
            ];

            foreach ($plans as $planData) {
                $features = $planData['features'] ?? [];
                unset($planData['features']);

                $plan = PricingPlan::create($planData);

                foreach ($features as $index => $feature) {
                    PricingFeature::create([
                        'pricing_plan_id' => $plan->id,
                        'feature' => $feature,
                        'sort_order' => ($index + 1) * 10,
                    ]);
                }
            }
        }

        if (Testimonial::count() === 0) {
            Testimonial::insert([
                [
                    'name' => 'Rahma Putri',
                    'role' => 'Owner Batik Nusantara',
                    'rating' => 5,
                    'quote' => 'Website kami tampak jauh lebih profesional dan mudah dikelola. Penjualan meningkat signifikan.',
                    'sort_order' => 10,
                ],
                [
                    'name' => 'Dimas Arya',
                    'role' => 'CMO Startup EduTech',
                    'rating' => 4.5,
                    'quote' => 'Kolaborasi menyenangkan dan hasil sesuai ekspektasi. Tim sangat memahami kebutuhan kami.',
                    'sort_order' => 20,
                ],
            ]);
        }

        if (ContactCard::count() === 0) {
            ContactCard::insert([
                [
                    'title' => 'WhatsApp',
                    'value' => '+62 881-0101-85772',
                    'description' => 'Fast response 08.00 - 21.00 WIB',
                    'icon' => 'heroicon-o-phone-arrow-up-right',
                    'link' => 'https://wa.me/62881010185772',
                    'sort_order' => 10,
                ],
                [
                    'title' => 'Email',
                    'value' => 'hello@alcaofficial.com',
                    'description' => 'Kirim brief atau pertanyaan kapan saja',
                    'icon' => 'heroicon-o-envelope',
                    'link' => 'mailto:hello@alcaofficial.com',
                    'sort_order' => 20,
                ],
            ]);
        }
    }
}
