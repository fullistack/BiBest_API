<?php

namespace Database\Seeders;

use App\Models\StudentAge;
use Illuminate\Database\Seeder;

class StudentAgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentAge::create(['age' => '7-10']);
        StudentAge::create(['age' => '11-16']);
        StudentAge::create(['age' => '17-25']);
        StudentAge::create(['age' => '26-45']);
        StudentAge::create(['age' => '46-60']);
        StudentAge::create(['age' => '60+']);
    }
}
