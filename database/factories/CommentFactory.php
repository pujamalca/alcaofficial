<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'commentable_type' => null,
            'commentable_id' => null,
            'user_id' => null,
            'parent_id' => null,
            'guest_name' => null,
            'guest_email' => null,
            'content' => $this->faker()->sentences(3, true),
            'is_approved' => $this->faker()->boolean(70),
            'is_featured' => $this->faker()->boolean(5),
            'likes_count' => $this->faker()->numberBetween(0, 100),
            'metadata' => null,
        ];
    }

    public function byUser(User $user): self
    {
        return $this->state(fn () => [
            'user_id' => $user->id,
            'guest_name' => null,
            'guest_email' => null,
        ]);
    }

    public function guest(): self
    {
        return $this->state(function () {
            return [
                'user_id' => null,
                'guest_name' => $this->faker()->name(),
                'guest_email' => $this->faker()->safeEmail(),
            ];
        });
    }
}
