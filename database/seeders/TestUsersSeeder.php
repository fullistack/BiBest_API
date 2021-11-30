<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        //test company
        $user = User::factory(1)->create(['name' => "test_company"])->first();
        $user->company()->create([
            "title"             => "test company",
            "inn"               => $faker->numberBetween(1000000,9999999),
            "country_iso"       => "RU",
            "city"              => $faker->city(),
            "address"           => $faker->address(),
            "post"              => $faker->numberBetween(10000,99999),
            "logo"              => Str::random(16).".jpg",
        ]);

        //test student
        $user = User::factory(1)->create(['name' => "test_student"])->first();
        $user->student()->create([
            "full_name" => "test student",
            "country_iso" => "RU"
        ]);

        //test teacher
        $user = User::factory(1)->create(['name' => "test_teacher"])->first();
        $user->teacher()->create([
            "user_id"       => $user->id,
            "avatar"        => "1.jpg",
            "passport"      => Str::random(2).$faker->numberBetween(1000000,9999999),
            "full_name"     => "test teacher",
            "country_iso"   => "RU",
            "city"          => $faker->city(),
            "address"       => $faker->address()
        ]);
    }
}
