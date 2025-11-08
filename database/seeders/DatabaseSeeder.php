<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RolePermissionSeeder::class,
            SettingSeeder::class,
            MarketingSeeder::class,
            AlcaOfficialShowcaseSeeder::class,
        ]);

        if (app()->environment(['local', 'testing'])) {
            $admin = User::updateOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'Administrator Sistem',
                    'username' => 'admin',
                    'email_verified_at' => now(),
                    'is_active' => true,
                    'password' => Hash::make('password'),
                ]
            );

            if (! $admin->hasRole('Super Admin')) {
                $admin->assignRole('Super Admin');
            }

            $editor = User::firstOrCreate(
                ['email' => 'editor@example.com'],
                [
                    'name' => 'Editor Konten',
                    'username' => 'editor',
                    'email_verified_at' => now(),
                    'is_active' => true,
                    'password' => Hash::make('password'),
                ]
            );

            if (! $editor->hasRole('Content Editor')) {
                $editor->assignRole('Content Editor');
            }
        }

        // Konten blog & landing page sudah di-handle oleh AlcaOfficialShowcaseSeeder
        // Jika membutuhkan konten acak tambahan, panggil ContentSeeder secara manual.
         // Buat user admin default
    $admin = User::updateOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'Administrator',
            'username' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'is_active' => true,
        ]
    );

    // Tambahkan role (pastikan role 'admin' atau 'super-admin' sudah ada di RolePermissionSeeder)
    if (class_exists(\Spatie\Permission\Models\Role::class)) {
        $admin->assignRole('Super Admin'); // ganti sesuai role yang kamu pakai
    }

    $this->command->info('✅ Admin user created: admin@example.com / password');
    }
}
