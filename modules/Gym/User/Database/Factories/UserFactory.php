<?php

namespace Gym\User\Database\Factories;

use Gym\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'staff_id' => 1,
            'name' => $this->faker->name,
//            'username' => $this->faker->username,
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->unique(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
