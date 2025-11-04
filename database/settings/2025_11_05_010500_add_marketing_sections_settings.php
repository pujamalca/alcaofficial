<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('landing_page.show_services', true);
        $this->migrator->add('landing_page.services_title', 'Solusi Kami');
        $this->migrator->add('landing_page.services_subtitle', 'Layanan digital untuk mendukung pertumbuhan bisnis Anda.');
        $this->migrator->add('landing_page.services', json_encode([], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $this->migrator->add('landing_page.show_portfolio', true);
        $this->migrator->add('landing_page.portfolio_title', 'Portfolio');
        $this->migrator->add('landing_page.portfolio_subtitle', 'Proyek pilihan yang pernah kami selesaikan.');
        $this->migrator->add('landing_page.portfolio_groups', json_encode([], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $this->migrator->add('landing_page.show_pricing', true);
        $this->migrator->add('landing_page.pricing_title', 'Harga');
        $this->migrator->add('landing_page.pricing_subtitle', 'Paket yang fleksibel sesuai kebutuhan Anda.');
        $this->migrator->add('landing_page.pricing_plans', json_encode([], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $this->migrator->add('landing_page.show_testimonials', true);
        $this->migrator->add('landing_page.testimonials_title', 'Testimoni');
        $this->migrator->add('landing_page.testimonials_subtitle', 'Cerita keberhasilan dari klien kami.');
        $this->migrator->add('landing_page.testimonials', json_encode([], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $this->migrator->add('landing_page.show_contact', true);
        $this->migrator->add('landing_page.contact_title', 'Hubungi Kami');
        $this->migrator->add('landing_page.contact_subtitle', 'Kami siap membantu Anda.');
        $this->migrator->add('landing_page.contact_description', '');
        $this->migrator->add('landing_page.contact_cards', json_encode([], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        $this->migrator->add('landing_page.contact_form_title', 'Hubungi Tim Kami');
        $this->migrator->add('landing_page.contact_form_subtitle', '');
        $this->migrator->add('landing_page.contact_form_success_message', 'Pesan Anda berhasil dikirim.');
    }

    public function down(): void
    {
        $this->migrator->deleteIfExists('landing_page.contact_form_success_message');
        $this->migrator->deleteIfExists('landing_page.contact_form_subtitle');
        $this->migrator->deleteIfExists('landing_page.contact_form_title');
        $this->migrator->deleteIfExists('landing_page.contact_cards');
        $this->migrator->deleteIfExists('landing_page.contact_description');
        $this->migrator->deleteIfExists('landing_page.contact_subtitle');
        $this->migrator->deleteIfExists('landing_page.contact_title');
        $this->migrator->deleteIfExists('landing_page.show_contact');

        $this->migrator->deleteIfExists('landing_page.testimonials');
        $this->migrator->deleteIfExists('landing_page.testimonials_subtitle');
        $this->migrator->deleteIfExists('landing_page.testimonials_title');
        $this->migrator->deleteIfExists('landing_page.show_testimonials');

        $this->migrator->deleteIfExists('landing_page.pricing_plans');
        $this->migrator->deleteIfExists('landing_page.pricing_subtitle');
        $this->migrator->deleteIfExists('landing_page.pricing_title');
        $this->migrator->deleteIfExists('landing_page.show_pricing');

        $this->migrator->deleteIfExists('landing_page.portfolio_groups');
        $this->migrator->deleteIfExists('landing_page.portfolio_subtitle');
        $this->migrator->deleteIfExists('landing_page.portfolio_title');
        $this->migrator->deleteIfExists('landing_page.show_portfolio');

        $this->migrator->deleteIfExists('landing_page.services');
        $this->migrator->deleteIfExists('landing_page.services_subtitle');
        $this->migrator->deleteIfExists('landing_page.services_title');
        $this->migrator->deleteIfExists('landing_page.show_services');
    }
};
