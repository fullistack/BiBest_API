<?php

namespace Database\Seeders;

use App\Models\CommunicationLanguage;
use App\Models\ConversationalAccent;
use App\Models\Country;
use App\Models\Language;
use App\Models\LearningAspect;
use App\Models\LearningLanguage;
use App\Models\Student;
use App\Models\StudentAge;
use App\Models\Teacher;
use App\Models\TeacherConversationalAccents;
use App\Models\TeacherDiploma;
use App\Models\TeacherEducation;
use App\Models\TeacherExperience;
use App\Models\TeacherLanguageCommunication;
use App\Models\TeacherLanguageLearning;
use App\Models\TeacherLessonContent;
use App\Models\TeacherLessonPrice;
use App\Models\TeacherStudentAge;
use App\Models\TeacherTest;
use App\Models\TeacherTrainingLevel;
use App\Models\TeacherTrainingSubject;
use App\Models\TrainingLevel;
use App\Models\TraningSubject;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $countries = Country::all();
        $languages = Language::all();
        $traningSubjects = TraningSubject::all();
        $studentAge = StudentAge::all();
        $conversationalAccents = ConversationalAccent::all();
        $traningLevels = TrainingLevel::all();
        $communicationLanguages = CommunicationLanguage::all();
        $learningLanguages = LearningLanguage::all();
        $learningAspect = LearningAspect::all();
        $users = DatabaseSeeder::$users->pop(DatabaseSeeder::TeacherCount);

        $avatars = [
            "1.jpg",
            "2.jpg",
            "3.jpg",
            "4.jpg",
            "5.jpg",
            "6.jpg",
            "7.jpg",
            "8.jpg",
        ];

        $videos = [
            'https://www.youtube.com/watch?v=kJ555V3xUmo&list=RDGMEMJQXQAmqrnmK1SEjY_rKBGAVMkJ555V3xUmo&index=2',
            'https://www.youtube.com/watch?v=ZwOo9xyyDkg&list=RDGMEMJQXQAmqrnmK1SEjY_rKBGAVMkJ555V3xUmo&index=3&ab_channel=Juhiz69',
            'https://www.youtube.com/watch?v=WxQ2XLFDyNI&list=RDGMEMJQXQAmqrnmK1SEjY_rKBGAVMkJ555V3xUmo&index=4&ab_channel=StuartTutt'
        ];


        foreach($users as $user){
            $teacher = $user->teacher()->create([
                "user_id"       => $user->id,
                "avatar"        => $faker->randomElement($avatars),
                "passport"      => Str::random(2).$faker->numberBetween(1000000,9999999),
                "full_name"     => $faker->firstName()." ".$faker->lastName(),
                "country_iso"   => $countries->random(1)->first()->iso,
                "city"          => $faker->city(),
                "address"       => $faker->address(),
                "about"         => $faker->realText(500),
                "video_welcome" => $faker->randomElement($videos)
            ]);
            for($j = 0;$j < rand(1,3);$j++){
                $teacher->diplomas()->create([
                    "diploma" => Str::random(16).".jpg"
                ]);
                $teacher->educations()->create([
                    "education" => $faker->company()
                ]);
                $teacher->experiences()->create([
                    "experience" => $faker->company()
                ]);
            }

            foreach ($communicationLanguages->random(rand(1,2)) as $cl){
                $teacher->languagesCommunication()->create([
                    "language_code" => $cl->code
                ]);
            }
            foreach ($learningLanguages->random(rand(1,2)) as $ll){
                $teacher->languagesLearning()->create([
                    "language_code" => $ll->code
                ]);
            }
            foreach ($traningSubjects->random(rand(1,2)) as $ts){
                $teacher->trainingSubjects()->create([
                    "subject_id" => $ts->id
                ]);
            }
            foreach ($studentAge->random(rand(1,2)) as $sa){
                $teacher->studentsAge()->create([
                    "age_id" => $sa->id
                ]);
            }

            $price = rand(10,30)*100;
            $teacher->lessonsPrice()->update([
                "lesson_1" => $price,
                "lesson_5" => $price*rand(2,5),
                "lesson_10" => $price*rand(7,10),
                "lesson_20" => $price*rand(15,20),
            ]);

            foreach ($conversationalAccents->random(rand(2,4)) as $ca){
                $teacher->conversationalAccents()->create([
                    "accent_id" => $ca->id
                ]);
            }
            foreach ($traningLevels->random(rand(2,4)) as $tl){
                $teacher->trainingLevel()->create([
                    "level_id" => $tl->id
                ]);
            }
            for($j = 0;$j < rand(2,4);$j++){
                $teacher->tests()->create([
                    "test" => $faker->realText(50)
                ]);
                $teacher->lessonContent()->create([
                    "content" => $faker->realText(50)
                ]);
            }

            foreach ($learningAspect->random(rand(2,4)) as $a){
                $teacher->learningAspect()->create([
                    "aspect_id" => $a->id
                ]);
            }
        }

    }
}
