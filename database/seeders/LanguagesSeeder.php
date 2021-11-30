<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create(["code" => "RU","title" => "Русский"]);
        Language::create(["code" => "EN","title" => "English"]);
        Language::create(["code" => "ES","title" => "Español"]);
    }
}
