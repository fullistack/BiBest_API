<?php

namespace Database\Seeders;

use App\Models\ConversationalAccent;
use Illuminate\Database\Seeder;

class ConversationalAccentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1;$i <= 10;$i++){
            ConversationalAccent::create(['accent' => "Accent ".$i]);
        }
    }
}
