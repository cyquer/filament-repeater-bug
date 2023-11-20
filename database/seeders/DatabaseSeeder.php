<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\House;
use App\Models\State;
use App\Models\Street;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run():void
    {
        \App\Models\User::factory()
            ->has(
                Country::factory(3)->has(
                    State::factory(3)->has(
                        City::factory(3)->has(
                            Street::factory(3)->has(
                                House::factory(3)
                            ),
                        )
                    )
                )
            )
            ->create([
            'name' =>'Test User',
            'email'=>'test@example.com',
        ]);
    }
}
