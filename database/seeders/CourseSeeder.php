<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CoursePlan;
use App\Models\CourseStudent;
use App\Models\GroupLessonStudent;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
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

        foreach ($companies as $company){
            for($i=0;$i<50;$i++){
                $teacher = $teachers->random(1)->first();
                $course = $company->courses()->create([
                    "teacher_id"            => $teacher->id,
                    "title"                 => $faker->jobTitle(),
                    "description"           => $faker->realText(300),
                    'date_start'            => $faker->dateTimeBetween('-7 days','+15 days'),
                    'time_start'            => $faker->numberBetween(0,11).":00:00",
                    'image'                 => Str::random(16).".jpg",
                    'price'                 => $teacher->lessonsPrice->lesson_20,
                    'students_max_count'    => $faker->numberBetween(5,15),
                    'lessons_duration'      => $faker->numberBetween(20,50),
                    'works_duration'        => $faker->numberBetween(5,10),
                    'tests_duration'        => $faker->numberBetween(10,15),
                    'training_level_id'     => $teacher->trainingLevel()->get("level_id")->random(1)->first()->level_id,
                    'student_age_id'        => $teacher->studentsAge()->get("age_id")->random(1)->first()->age_id,
                ]);
                $course_students = $students->random(rand(5,$course->students_max_count));
                $statuses = collect(CourseStudent::STATUSES);
                foreach ($course_students as $student){
                    $status = $statuses->random(1)->first();
                    $course->students()->create([
                        "student_id"    => $student->id,
                        "status"        => $status,
                        "text"          => $status == "excluded" ? $faker->realText(50) : null
                    ]);
                }
                $lessons_duration = $course->lessons_duration;
                $works_duration = $course->works_duration;
                $tests_duration = $course->tests_duration;
                $data_start_obj = Carbon::create($course->date_start);
                while ($lessons_duration > 0){
                    $ld = $faker->numberBetween(1,3);
                    $lessons_duration -= $ld;
                    if($lessons_duration < 0){
                        $ld = $ld + $lessons_duration;
                    }
                    $course->plans()->create([
                        "type"          => CoursePlan::TYPE_LESSON,
                        "title"         => $faker->jobTitle(),
                        "duration"      => $ld,
                        "date_start"    => $data_start_obj->addDays($faker->numberBetween(0,20)),
                    ]);
                }
                while ($works_duration > 0){
                    $ld = $faker->numberBetween(1,3);
                    $works_duration -= $ld;
                    if($works_duration < 0){
                        $ld = $ld + $works_duration;
                    }
                    $course->plans()->create([
                        "type"          => CoursePlan::TYPE_WORK,
                        "title"         => $faker->jobTitle(),
                        "duration"      => $ld,
                        "date_start"    => $data_start_obj->addDays($faker->numberBetween(0,20)),
                    ]);
                }
                while ($tests_duration > 0){
                    $ld = $faker->numberBetween(1,3);
                    $tests_duration -= $ld;
                    if($tests_duration < 0){
                        $ld = $ld + $tests_duration;
                    }
                    $course->plans()->create([
                        "type"          => CoursePlan::TYPE_TEST,
                        "title"         => $faker->jobTitle(),
                        "duration"      => $ld,
                        "date_start"    => $data_start_obj->addDays($faker->numberBetween(0,20)),
                    ]);
                }
            }
        }

    }
}
