<?php

namespace App\Http\Controllers;

use App\Models\ConversationalAccent;
use App\Models\Country;
use App\Models\Language;
use App\Models\LearningAspect;
use App\Models\LessonDuration;
use App\Models\StudentAge;
use App\Models\TrainingLevel;
use App\Models\TraningSubject;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct()
    {
        App::setLocale(Request::header("locale","ru"));
    }

    function response($data = null,$http_status = Response::HTTP_OK,$headers = []){
        return response()->json($data,$http_status,$headers);
    }

    function getLists(){
        $lists = [];
        $lists['countries'] = Country::query()->select("iso","title")->where("language_code",App::getLocale())->get();
        $lists['languages'] = Language::query()->get();
        $lists['student_ages'] = StudentAge::all();
        $lists['training_level'] = TrainingLevel::all();
        $lists['training_subject'] = TraningSubject::all();
        $lists['learning_language'] = ['RU','EN','PT','DE'];
        $lists['communication_language'] = ['RU','EN','PT'];
        $lists['conversational_accents'] = ConversationalAccent::all();
        $lists['lesson_duration'] = LessonDuration::all();
        $lists['learning_aspects'] = LearningAspect::all();
        return $this->response($lists);
    }
}
