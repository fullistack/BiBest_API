<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $countries = Country::all();
        $users = DatabaseSeeder::$users->pop(DatabaseSeeder::CompanyCount);

        foreach($users as $user) {
            $user->company()->create([
                "title"             => $faker->jobTitle(),
                "inn"               => $faker->numberBetween(1000000,9999999),
                "country_iso"       => $countries->random(1)->first()->iso,
                "city"              => $faker->city(),
                "address"           => $faker->address(),
                "post"              => $faker->numberBetween(10000,99999),
                "logo"              => Str::random(16).".jpg",
            ]);
        }

    }
}
