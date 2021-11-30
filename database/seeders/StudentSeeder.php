<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Student;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $countries = Country::all();
        $users = DatabaseSeeder::$users->pop(DatabaseSeeder::StudentCount);

        foreach($users as $user){
            $user->student()->create([
                "full_name" => $faker->firstName()." ".$faker->lastName(),
                "country_iso" => $countries->random(1)->first()->iso,
            ]);
        }


    }
}
