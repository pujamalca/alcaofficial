<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        $word = $this->faker()->unique()->word();

        return [
            'name' => ucfirst($word),
            'type' => 'post',
            'color' => $this->faker()->optional()->hexColor(),
            'description' => $this->faker()->optional()->sentence(),
            'metadata' => null,
        ];
    }
}

