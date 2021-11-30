<?php

namespace Database\Seeders;

use App\Models\ConversationalAccent;
use App\Models\Forum;
use App\Models\GroupLesson;
use App\Models\LearningAspect;
use App\Models\StudentAge;
use App\Models\TrainingLevel;
use App\Models\TraningSubject;
use App\Models\User;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Types\Self_;

class DatabaseSeeder extends Seeder
{
    const StudentCount = 300;
    const TeacherCount = 100;
    const CompanyCount = 100;

    static $users;

    public function run()
    {
        $this->call(LanguagesSeeder::class);
        $this->call(CountrySeeder::class);

        $this->call(StudentAgeSeeder::class);
        $this->call(TrainingSubjectSeeder::class);
        $this->call(ConversationalAccentsSeeder::class);
        $this->call(TrainingLavelSeeder::class);
        $this->call(CommunicationLanguageSeeder::class);
        $this->call(LearningLanguageSeeder::class);
        $this->call(LessonDurationSeeder::class);
        $this->call(LearningAspectSeeder::class);

        $this->call(UserSeeder::class);

        $this->call(StudentSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(CompanySeeder::class);

        $this->call(ReviewSeeder::class);

        $this->call(GroupLessonSeeder::class);
        $this->call(CourseSeeder::class);

        $this->call(TestUsersSeeder::class);

        $this->call(ForumSeeder::class);
    }

}
