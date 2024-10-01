<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        return [
            'first_name' => $gender === 'male' ? $this->faker->firstNameMale : $this->faker->firstNameFemale,
            'last_name' => $this->faker->lastName,
            'gender' => $gender,
            'birthdate' => $this->faker->date('Y-m-d', '2000-12-31'),
        ];
    }
}
