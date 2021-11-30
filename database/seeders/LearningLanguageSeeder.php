<?php

namespace Database\Seeders;

use App\Models\LearningLanguage;
use Illuminate\Database\Seeder;

class LearningLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LearningLanguage::create(['title' => 'русский','code' => 'RU']);
        LearningLanguage::create(['title' => 'английский','code' => 'EN']);
        LearningLanguage::create(['title' => 'португальский','code' => 'PT']);
    }
}
