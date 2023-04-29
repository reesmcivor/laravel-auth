<?php

namespace ReesMcIvor\Auth\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    public function definition() : array
    {
        return [
            'id' => 1,
            'name' => $this->faker->name,
        ];
    }
}
