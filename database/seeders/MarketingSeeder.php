<?php

namespace Database\Seeders;

use App\Models\ContactCard;
use App\Models\PortfolioGroup;
use App\Models\PortfolioItem;
use App\Models\PricingFeature;
use App\Models\PricingPlan;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class MarketingSeeder extends Seeder
{
    public function run(): void
    {
        if (Service::count() === 0) {
            Service::insert([
                [
                    'title' => 'Company Profile',
                    'icon' => 'heroicon-o-globe-alt',
                    'description' => 'Website profesional untuk perkuat branding perusahaan.',
                    'sort_order' => 10,
                ],
                [
                    'title' => 'E-Commerce',
                    'icon' => 'heroicon-o-shopping-cart',
                    'description' => 'Platform jual beli online lengkap dengan payment gateway.',
                    'sort_order' => 20,
                ],
                [
                    'title' => 'Landing Page Campaign',
                    'icon' => 'heroicon-o-rocket-launch',
                    'description' => 'Optimalkan konversi iklan digital dengan landing page fokus.',
                    'sort_order' => 30,
                ],
            ]);
        }

        if (PortfolioGroup::count() === 0) {
            $companyGroup = PortfolioGroup::create([
                'name' => 'Company Profile',
                'description' => 'Website informatif untuk memperkuat kepercayaan calon klien.',
                'sort_order' => 10,
            ]);

            PortfolioItem::create([
                'portfolio_group_id' => $companyGroup->id,
                'title' => 'PT Sukses Makmur',
                'category' => 'Manufaktur',
                'description' => 'Website company profile dengan katalog produk digital dan CTA konsultasi.',
                'sort_order' => 10,
            ]);

            $ecommerceGroup = PortfolioGroup::create([
                'name' => 'E-Commerce',
                'description' => 'Solusi toko online untuk berbagai lini bisnis.',
                'sort_order' => 20,
            ]);

            PortfolioItem::create([
                'portfolio_group_id' => $ecommerceGroup->id,
                'title' => 'Fashionista Premium Store',
                'category' => 'Retail',
                'description' => 'E-commerce fashion dengan fitur membership & loyalty points.',
                'sort_order' => 10,
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
