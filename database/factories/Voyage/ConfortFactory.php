<?php

namespace Database\Factories\Voyage;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ConfortFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        return [
            'title'=>fake()->sentence(rand(3,6)),
            'description'=>fake()->paragraphs(asText: true),
            'user_id'=>$users->random()->id,
        ];
    }
}
