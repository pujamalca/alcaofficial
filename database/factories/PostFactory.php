<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker()->unique()->sentence(6);
        $seoTitle = $this->faker()->optional()->words(6, true);
        $seoDescription = $this->faker()->optional()->sentences(3, true);

        return [
            'category_id' => Category::factory(),
            'author_id' => User::factory(),
            'title' => $title,
            'excerpt' => $this->faker()->optional()->paragraph(),
            'content' => $this->faker()->paragraphs(6, true),
            'featured_image' => null,
            'gallery' => $this->faker()->optional()->randomElements([
                $this->faker()->imageUrl(800, 600, 'nature'),
                $this->faker()->imageUrl(800, 600, 'city'),
                $this->faker()->imageUrl(800, 600, 'tech'),
            ], $this->faker()->numberBetween(0, 3)),
            'type' => $this->faker()->randomElement(['article', 'page', 'news']),
            'status' => $this->faker()->randomElement(['draft', 'published']),
            'published_at' => $this->faker()->optional()->dateTimeBetween('-1 month', 'now'),
            'scheduled_at' => null,
            'is_featured' => $this->faker()->boolean(10),
            'is_sticky' => $this->faker()->boolean(5),
            'view_count' => $this->faker()->numberBetween(0, 5000),
            'reading_time' => $this->faker()->numberBetween(2, 10),
            'seo_title' => $seoTitle ? Str::limit($seoTitle, 60, '') : null,
            'seo_description' => $seoDescription ? Str::limit($seoDescription, 160, '') : null,
            'seo_keywords' => $this->faker()->optional()->words(5, true),
            'og_image' => $this->faker()->optional()->imageUrl(1200, 630, 'business'),
            'metadata' => [
                'source' => $this->faker()->optional()->company(),
            ],
        ];
    }
}
