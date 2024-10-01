<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roleNames = ['Admin', 'User', 'Manager', 'Editor', 'Viewer', 'Moderator', 'Guest', 'Developer', 'Support', 'Analyst'];
        $name = $this->faker->unique()->randomElement($roleNames);

        return [
            'name' => $name,
            'code' => Str::slug($name)
        ];
    }
}
