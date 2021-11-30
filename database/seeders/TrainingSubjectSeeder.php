<?php

namespace Database\Seeders;

use App\Models\TraningSubject;
use Illuminate\Database\Seeder;

class TrainingSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TraningSubject::create(['subject' => 'английский язык']);
        TraningSubject::create(['subject' => 'немецкий язык']);
        TraningSubject::create(['subject' => 'бизнес-аналитик']);
        TraningSubject::create(['subject' => 'java-разработка']);
        TraningSubject::create(['subject' => 'маркетолог']);
    }
}
