<?php

namespace Database\Seeders;

use App\Models\LearningAspect;
use Illuminate\Database\Seeder;

class LearningAspectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LearningAspect::create([
            "aspect" => "Accent Reduction"
        ]);

        LearningAspect::create([
            "aspect" => "Business english"
        ]);

        LearningAspect::create([
            "aspect" => "Grammar Development"
        ]);

        LearningAspect::create([
            "aspect" => "Phonetics"
        ]);
    }
}
