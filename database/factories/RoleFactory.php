<?php

namespace ReesMcIvor\Auth\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ReesMcIvor\Auth\Models\Role;

class RoleFactory extends Factory
{

    protected $model = Role::class;

    public function definition() : array
    {
        return [
            'id' => 1,
            'name' => $this->faker->name,
        ];
    }
}
