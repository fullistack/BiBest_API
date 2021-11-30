<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForumMessageRequest;
use App\Http\Resources\ForumListResource;
use App\Http\Resources\ForumMessageResource;
use App\Http\Resources\ForumResource;
use App\Http\Resources\ForumThemeResource;
use App\Models\Forum;
use App\Models\ForumTheme;
use App\Models\ForumThemeMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    function index(Request $request){
        $limit = $request->get("limit",10);
        $offset = $request->get("offset",0);
        $forums = Forum::query()->limit($limit)->offset($offset)->get();
        $out = [
            "forums" => ForumListResource::collection($forums),
            "count" => Forum::all()->count()
        ];
        return $this->response($out);
    }

    function forum($forum_id){
        $forum = Forum::findOrFail($forum_id);
        return $this->response(ForumResource::make($forum));
    }

    function theme($theme_id){
        $theme = ForumTheme::findOrFail($theme_id);
        return $this->response(ForumThemeResource::make($theme));
    }

    function message(ForumMessageRequest $request,$theme_id){
        $theme = ForumTheme::findOrFail($theme_id);
        $user_id = Auth::user()->id;
        $message = new ForumThemeMessage();
        $message->message = $request->get("message");
        $message->message_id = $request->get("message_id",null);
        $message->user_id = $user_id;
        $message->theme_id = $theme->id;
        $message->save();
        return $this->response(ForumMessageResource::make($message));
    }
}
