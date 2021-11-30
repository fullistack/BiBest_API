<?php

namespace App\Http\Controllers\Profile\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherAccountUpdateRequest;
use App\Http\Requests\Teacher\TeacherInfoUpdateRequest;
use App\Http\Resources\TeacherProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherProfileController extends Controller
{
    function index(){
        $teacher = Auth::user()->teacher;
        return $this->response(TeacherProfileResource::make($teacher));
    }

    function updateAccount(TeacherAccountUpdateRequest $request){
        $teacher_data = $request->only("full_name","avatar");
        $user_data = $request->only("email","phone","password","name","gender");
        $user = Auth::user();
        $user->update($user_data);
        $user->teacher()->update($teacher_data);
        return $this->response(true);
    }

    function updateInfo(TeacherInfoUpdateRequest $request){
        $user_settings_data = $request->only("language_code","time_zone");
        $teacher_data = $request->only("country_iso","about","video_welcome");
        $learning_languages_data = $request->get("learning_languages",[]);
        $communication_languages_data = $request->get("communication_languages",[]);
        $student_ages_data = $request->get("student_ages",[]);
        $training_subjects_data = $request->get("training_subjects",[]);
        $lesson_prices_data = $request->get("lesson_prices",[]);
        $training_levels_data = $request->get("training_levels",[]);
        $conversational_accents_data = $request->get("conversational_accents",[]);
        $lesson_contents_data = $request->get("lesson_contents",[]);
        $tests_data = $request->get("tests",[]);
        $educations_data = $request->get("educations",[]);
        $experiences_data = $request->get("experiences",[]);
        $diplomas_data = $request->get("diplomas",[]);

        $user = Auth::user();

        if($user_settings_data){
            $user->settings()->update($user_settings_data);
        }

        if($teacher_data){
            $user->teacher()->update($teacher_data);
        }

        $teacher = $user->teacher;

        if($lesson_prices_data){
            $teacher->lessonsPrice()->update($lesson_prices_data);
        }

        if($learning_languages_data){
            $teacher->languagesLearning()->delete();
            foreach ($learning_languages_data as $language_code){
                $teacher->languagesLearning()->create(['language_code' => $language_code]);
            }
        }

        if($communication_languages_data){
            $teacher->languagesCommunication()->delete();
            foreach ($communication_languages_data as $language_code){
                $teacher->languagesCommunication()->create(['language_code' => $language_code]);
            }
        }

        if($student_ages_data){
            $teacher->studentsAge()->delete();
            foreach ($student_ages_data as $age_id) {
                $teacher->studentsAge()->create(['age_id' => $age_id]);
            }
        }

        if($training_subjects_data){
            $teacher->trainingSubjects()->delete();
            foreach ($training_subjects_data as $subject_id){
                $teacher->trainingSubjects()->create(['subject_id' => $subject_id]);
            }
        }

        if($training_levels_data){
            $teacher->trainingLevel()->delete();
            foreach ($training_levels_data as $level_id){
                $teacher->trainingLevel()->create(['level_id' => $level_id]);
            }
        }

        if($conversational_accents_data){
            $teacher->conversationalAccents()->delete();
            foreach ($conversational_accents_data as $accent_id){
                $teacher->conversationalAccents()->create(['accent_id' => $accent_id]);
            }
        }

        if($lesson_contents_data){
            $teacher->lessonContent()->delete();
            foreach ($lesson_contents_data as $content){
                $teacher->lessonContent()->create(['content' => $content]);
            }
        }

        if($tests_data){
            $teacher->tests()->delete();
            foreach ($tests_data as $test){
                $teacher->tests()->create(['test' => $test]);
            }
        }

        if($educations_data){
            $teacher->educations()->delete();
            foreach ($educations_data as $education){
                $teacher->educations()->create(['education' => $education]);
            }
        }

        if($experiences_data){
            $teacher->experiences()->delete();
            foreach ($experiences_data as $experience){
                $teacher->experiences()->create(['experience' => $experience]);
            }
        }

        if($diplomas_data){
            $teacher->diplomas()->delete();
            foreach ($diplomas_data as $diploma){
                $teacher->diplomas()->create(['diploma' => $diploma]);
            }
        }

        return $this->response(true);
    }


}
