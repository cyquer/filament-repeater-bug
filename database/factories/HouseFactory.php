<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HouseFactory  extends Factory
{

    public function definition(): array
    {
        return [
            'name'=>'House: '.fake()->name,
        ];
    }
}
