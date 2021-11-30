<?php

namespace Database\Seeders;

use App\Models\TrainingLevel;
use Illuminate\Database\Seeder;

class TrainingLavelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TrainingLevel::create(['level' => "starter"]);
        TrainingLevel::create(['level' => "junior"]);
        TrainingLevel::create(['level' => "middle"]);
        TrainingLevel::create(['level' => "senior"]);
        TrainingLevel::create(['level' => "proficiency"]);
    }
}
