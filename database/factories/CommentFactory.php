<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'content' => $this->faker->sentence(),
            'user_id' => 929055031364354049,
            'post_id' => 929054201752977409,
        ];
    }
}
