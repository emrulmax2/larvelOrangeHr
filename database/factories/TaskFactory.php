<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Todo;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'todo_id' => function () {
                
                if ($todo = Todo::find(rand(1,10))) {
                    return $todo->id;
                }
                return Todo::factory()->create()->id;
            },
            'name' => fake()->sentence(),
        ];
    }
}
