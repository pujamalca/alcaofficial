<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissionDefinitions = [
            [
                'slug' => 'access-admin-panel',
                'label' => 'Access Admin Panel',
                'module' => 'system',
                'description' => 'Akses penuh ke panel admin.',
            ],
            [
                'slug' => 'manage-users',
                'label' => 'Manage Users',
                'module' => 'users',
                'description' => 'Mengelola data pengguna termasuk role & status aktif.',
            ],
            [
                'slug' => 'manage-roles',
                'label' => 'Manage Roles',
                'module' => 'users',
                'description' => 'Mengelola role dan permission.',
            ],
            [
                'slug' => 'manage-permissions',
                'label' => 'Manage Permissions',
                'module' => 'users',
                'description' => 'Mengelola daftar permission yang tersedia.',
            ],
            [
                'slug' => 'access-settings',
                'label' => 'Access Settings',
                'module' => 'system',
                'description' => 'Akses halaman pengaturan aplikasi.',
            ],
            [
                'slug' => 'manage-posts',
                'label' => 'Manage Posts',
                'module' => 'content',
                'description' => 'Membuat dan mengelola postingan.',
            ],
            [
                'slug' => 'manage-categories',
                'label' => 'Manage Categories',
                'module' => 'content',
                'description' => 'Mengelola struktur kategori konten.',
            ],
            [
                'slug' => 'manage-tags',
                'label' => 'Manage Tags',
                'module' => 'content',
                'description' => 'Mengelola tag untuk klasifikasi konten.',
            ],
            [
                'slug' => 'manage-comments',
                'label' => 'Manage Comments',
                'module' => 'content',
                'description' => 'Moderasi dan penyuntingan komentar.',
            ],
            [
                'slug' => 'view-activity-log',
                'label' => 'View Activity Log',
                'module' => 'system',
                'description' => 'Melihat catatan aktivitas aplikasi.',
            ],
            [
                'slug' => 'manage-pages',
                'label' => 'Manage Pages',
                'module' => 'content',
                'description' => 'Mengelola halaman statis.',
            ],
            [
                'slug' => 'manage-media',
                'label' => 'Manage Media',
                'module' => 'content',
                'description' => 'Mengelola file media dan galeri.',
            ],
            [
                'slug' => 'manage-services',
                'label' => 'Manage Services',
                'module' => 'website',
                'description' => 'Mengelola layanan yang ditawarkan.',
            ],
            [
                'slug' => 'manage-pricing',
                'label' => 'Manage Pricing',
                'module' => 'website',
                'description' => 'Mengelola paket harga dan pricing plan.',
            ],
            [
                'slug' => 'manage-testimonials',
                'label' => 'Manage Testimonials',
                'module' => 'website',
                'description' => 'Mengelola testimoni pelanggan.',
            ],
            [
                'slug' => 'manage-contacts',
                'label' => 'Manage Contacts',
                'module' => 'website',
                'description' => 'Mengelola pesan kontak dari pelanggan.',
            ],
            [
                'slug' => 'manage-portfolio',
                'label' => 'Manage Portfolio',
                'module' => 'website',
                'description' => 'Mengelola portfolio proyek.',
            ],
            [
                'slug' => 'manage-source-codes',
                'label' => 'Manage Source Codes',
                'module' => 'ecommerce',
                'description' => 'Mengelola source code yang dijual.',
            ],
            [
                'slug' => 'manage-orders',
                'label' => 'Manage Orders',
                'module' => 'ecommerce',
                'description' => 'Mengelola order pembelian source code.',
            ],
        ];

        $permissions = collect($permissionDefinitions)->mapWithKeys(function (array $attributes) {
            $permission = Permission::updateOrCreate(
                ['slug' => $attributes['slug']],
                [
                    'name' => $attributes['slug'],
                    'slug' => $attributes['slug'],
                    'module' => $attributes['module'],
                    'description' => $attributes['description'],
                    'guard_name' => 'web',
                    'metadata' => [
                        'label' => $attributes['label'],
                    ],
                ]
            );

            return [$permission->slug => $permission];
        });

        $superAdmin = Role::updateOrCreate(
            ['slug' => 'super-admin'],
            [
                'name' => 'Super Admin',
                'description' => 'Memiliki akses penuh ke seluruh fitur.',
                'guard_name' => 'web',
                'is_system' => true,
            ]
        );

        $superAdmin->syncPermissions($permissions->values());

        $contentEditor = Role::updateOrCreate(
            ['slug' => 'content-editor'],
            [
                'name' => 'Content Editor',
                'description' => 'Mengelola konten tanpa akses ke pengaturan kritikal.',
                'guard_name' => 'web',
            ]
        );

        $contentEditor->syncPermissions(
            $permissions->only([
                'access-admin-panel',
                'manage-posts',
                'manage-categories',
                'manage-tags',
                'manage-comments',
            ])->values()
        );
    }
}
