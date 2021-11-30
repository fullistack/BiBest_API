<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserReview;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_ids = User::all()->filter(function (User $user){
            return $user->isCompany() || $user->isTeacher();
        })->map(function (User $user){
            return $user->id;
        })->values();

        $users_ids_all = User::all()->map(function (User $user){
            return $user->id;
        });

        foreach ($users_ids as $user_id){
            foreach (UserReview::factory(rand(2,20))->raw() as $review){
                $review["reviewer_id"] = $users_ids_all->random(1)->first();
                $review["user_id"] = $user_id;
                $review = UserReview::create($review);
                for($i=0;$i<rand(0,20);$i++){
                    $like = [
                        "user_id" => $users_ids_all->random(1)->first(),
                        "value" => rand(0,1) == 1 ? 1 : -1
                    ];
                    $review->likes()->create($like);
                }
            }
        }


    }
}
