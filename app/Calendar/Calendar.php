<?php


namespace App\Calendar;

use App\Models\GroupLesson;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Calendar
{
    static function make(Collection $lessons,Collection $courses)
    {
        $lessons = $lessons->whereBetween("date_start",[Carbon::now(),Carbon::now()->addDays(6)]);
        //$courses = $courses->whereBetween("date_start",[Carbon::now(),Carbon::now()->addDays(6)]);
        $lessons->map(function (GroupLesson $lesson){

            $duration = $lesson->duration->duration;
            $d_p = explode(".",$duration);
            if(!isset($d_p[1])){
                $d_p[1] = 0;
            }
            $lesson['time_end'] = Carbon::create($lesson->time_start)->addHours($d_p[0])->addMinutes($d_p[1])->toTimeString();
        });
        return $lessons->values();
    }

}
