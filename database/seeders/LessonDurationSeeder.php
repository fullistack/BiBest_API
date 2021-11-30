<?php

namespace Database\Seeders;

use App\Models\LessonDuration;
use Illuminate\Database\Seeder;

class LessonDurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(0.5,3,0.5) as $duration){
            LessonDuration::create([
                "duration" => $duration,
            ]);
        }
    }
}
