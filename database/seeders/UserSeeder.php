<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $people = Person::all();

        $people->each(function ($person) {
            User::factory()->create([
                'name' => Str::slug($person->first_name . $person->id),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'active' => (bool)random_int(0, 1),
                'locked' => (bool)random_int(0, 1),
                'person_id' => $person->id,
                'remember_token' => Str::random(10),
            ]);
        });
    }
}
