<?php

namespace Database\Seeders;


use App\Models\Call;
use App\Models\City;
use App\Models\Client;
use App\Models\Country;
use App\Models\States;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $faker = Faker::create();
//         \App\Models\User::factory(10)->create();
//
//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);

//
        for ($i = 0; $i < 5; $i++) {
            Country::create([
                'ref_id' => uniqid(),
                'name' => $faker->country,
                'code' => $faker->countryCode,
                'is_active' => true,
            ]);
        }


        $countries = Country::all();

        foreach ($countries as $country) {
            for ($i = 0; $i < 20; $i++) {
                States::create([
                    'state' => $faker->state,
                    'country_id' => $country->id,
                ]);
            }
        }

        $states = States::all();

        foreach ($states as $state) {
            for ($i = 0; $i < 15; $i++) {
                City::create([
                    'city' => $faker->city,
                    'states_id' => $state->id,
                ]);
            }
        }


        $cities = City::all();

        foreach ($cities as $city) {
            for ($i = 0; $i < 5000; $i++) {
                Client::create([
                    'company' => $faker->company,
                    'city_id' => $city->id
                ]);
            }
        }


        $clients = Client::all();
        foreach ($clients as $client) {
            for ($i = 0; $i < 5; $i++) {
                Call::create([
                    'client_id' => $client->id
                ]);
            }
        }

    }
}
