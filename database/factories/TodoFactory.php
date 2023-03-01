<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                if ($user = User::find(1)) {
                    return $user->id;
                }
                return factory(User::class)->create()->id;
            },
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
        ];
    }
}
