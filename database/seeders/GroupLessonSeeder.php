<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\GroupLesson;
use App\Models\GroupLessonStudent;
use App\Models\LessonDuration;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TrainingLevel;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GroupLessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $students = Student::all();
        $teachers = Teacher::all();
        $companies = Company::all();
        $lessonDurations = LessonDuration::all();
        $statuses = collect(GroupLessonStudent::STATUSES);

        $images = [
            "1.jpg",
            "2.jpg",
            "3.jpg",
            "4.jpg",
        ];

        foreach ($teachers as $teacher){
            for($i=0;$i<50;$i++){
                $lesson = $teacher->lessons()->create([
                    'title'                 => $faker->jobTitle(),
                    'description'           => $faker->realText(300),
                    'date_start'            => $faker->dateTimeBetween('-7 days','+15 days'),
                    'time_start'            => $faker->numberBetween(0,11).":00:00",
                    'image'                 => $faker->randomElement($images),
                    'price'                 => $teacher->lessonsPrice->lesson_1,
                    'students_max_count'    => $faker->numberBetween(5,15),
                    'lesson_duration_id'    => $lessonDurations->random(1)->first()->id,
                    'training_level_id'     => $teacher->trainingLevel()->get("level_id")->random(1)->first()->level_id,
                    'student_age_id'        => $teacher->studentsAge()->get("age_id")->random(1)->first()->age_id,
                    'company_id'            => $faker->numberBetween(0,5) > 3 ? $companies->random(1)->first()->id : null,
                ]);
                $lesson_students = $students->random(rand(5,$lesson->students_max_count));
                foreach ($lesson_students as $student){
                    $status = $statuses->random(1)->first();
                    $lesson->students()->create([
                        "student_id"    => $student->id,
                        "status"        => $status,
                        "text"          => $status == "excluded" ? $faker->realText(50) : null
                    ]);
                }
            }
        }
    }
}
