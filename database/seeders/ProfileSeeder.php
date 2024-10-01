<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $roles = Role::all();
        for ($i = 1; $i <= 18000; $i++) {
            $randomUser = $users->random();
            $randomRole = $roles->random();

            Profile::factory()->create([
                'description' => fake()->sentence(),
                'active' => fake()->boolean(),
                'user_id' => $randomUser->id,
                'role_id' => $randomRole->id
            ]);
        }
    }
}
