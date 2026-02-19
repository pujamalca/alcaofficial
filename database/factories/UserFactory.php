<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories.Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<User>
     */
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $indonesianNames = [
            'Budi Santoso', 'Ani Wijaya', 'Dedi Pratama', 'Siti Nurhaliza',
            'Eko Saputra', 'Rina Kusuma', 'Ahmad Fauzi', 'Dewi Lestari',
            'Rizki Ramadhan', 'Maya Sari', 'Fajar Nugroho', 'Linda Permata',
            'Hendra Gunawan', 'Putri Wulandari', 'Irfan Hakim', 'Ratna Dewi',
            'Bambang Wijaya', 'Indah Safitri', 'Tono Sugiarto', 'Ayu Lestari',
        ];

        $bios = [
            'Content Creator & Digital Marketer',
            'Web Developer & Tech Enthusiast',
            'Freelance Writer',
            'UI/UX Designer',
            'Software Engineer',
            'Digital Marketing Specialist',
            'Full Stack Developer',
            'Blogger & Photographer',
        ];

        // Nama & username
        $name = $indonesianNames[array_rand($indonesianNames)];
        $username = Str::slug(explode(' ', $name)[0]) . rand(100, 999);

        // Email unik sederhana
        $email = Str::slug($name) . rand(1, 999) . '@example.com';

        // Nomor HP sederhana
        $phone = '08' . rand(10, 99) . '-' . rand(1000, 9999) . '-' . rand(1000, 9999);

        // Bio random
        $bio = $bios[array_rand($bios)];

        return [
            'name'              => $name,
            'username'          => $username,
            'email'             => $email,
            'email_verified_at' => now(),
            'phone'             => $phone,
            // Bisa null atau avatar default
            'avatar'            => null,
            'bio'               => $bio,
            'is_active'         => true,
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
