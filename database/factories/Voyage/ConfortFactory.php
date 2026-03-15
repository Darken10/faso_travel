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
        // Use first admin user, falling back to any user, then null (model will handle it)
        $user = User::whereIn('role', ['admin', 'root'])->first()
            ?? User::first();

        return [
            'title'=>fake()->sentence(rand(3,6)),
            'description'=>fake()->paragraphs(asText: true),
            'user_id'=>$user->id ?? null,
        ];
    }
}
