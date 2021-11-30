<?php

namespace Database\Seeders;

use App\Models\CommunicationLanguage;
use Illuminate\Database\Seeder;

class CommunicationLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommunicationLanguage::create(['title' => 'русский','code' => 'RU']);
        CommunicationLanguage::create(['title' => 'английский','code' => 'EN']);
        CommunicationLanguage::create(['title' => 'немецкий','code' => 'DE']);
        CommunicationLanguage::create(['title' => 'португальский','code' => 'PT']);
    }
}
