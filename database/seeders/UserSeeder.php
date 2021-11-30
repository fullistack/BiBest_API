<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_count = DatabaseSeeder::CompanyCount + DatabaseSeeder::TeacherCount + DatabaseSeeder::StudentCount;
        DatabaseSeeder::$users = User::factory($users_count)->create();
    }
}
