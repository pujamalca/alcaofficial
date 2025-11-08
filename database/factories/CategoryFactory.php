<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker()->unique()->words(2, true);

        return [
            'name' => ucfirst($name),
            'description' => $this->faker()->optional()->paragraph(),
            'image' => $this->faker()->optional()->imageUrl(),
            'icon' => $this->faker()->optional()->lexify('icon-????'),
            'color' => $this->faker()->optional()->hexColor(),
            'sort_order' => $this->faker()->numberBetween(0, 10),
            'is_featured' => $this->faker()->boolean(20),
            'is_active' => true,
            'metadata' => [
                'seo' => [
                    'title' => ucfirst($name),
                    'description' => $this->faker()->sentence(),
                ],
            ],
        ];
    }
}

