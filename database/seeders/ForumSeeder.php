<?php

namespace Database\Seeders;

use App\Models\Forum;
use App\Models\ForumTheme;
use App\Models\ForumThemeMessage;
use App\Models\User;
use Database\Factories\ForumThemeMessageFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $forums = Forum::factory(15)->create();
        $themes = [];
        foreach (ForumTheme::factory(100)->raw() as $theme){
            $theme_model = new ForumTheme();
            $theme_model->forum_id = $forums->random(1)->first()->id;
            $theme_model->user_id = $users->random(1)->first()->id;
            $theme_model->title = $theme['title'];
            $theme_model->type = $theme['type'];
            $theme_model->created_at = $theme['created_at'];
            $theme_model->save();
            $themes[] = $theme_model;
        }
        $themes = collect($themes);
        $messages = [];
        foreach (ForumThemeMessage::factory(5000)->raw() as $message){
            $message_model = new ForumThemeMessage();
            $message_model->message = $message['message'];
            $message_model->created_at = $message['created_at'];
            $message_model->user_id = $users->random(1)->first()->id;
            $message_model->theme_id = $themes->random(1)->first()->id;
            $message_model->save();
            $messages[] = $message_model;
        }
        $messages = collect($messages);
        $messages->groupBy("theme_id")->each(function (Collection $item){
            foreach ($item->random(rand(0,2)) as $c){
                $id = $item->random(1)->first()->id;
                if($id != $c->id){
                    $c->message_id = $id;
                    $c->save();
                }
            }
        });
    }
}
