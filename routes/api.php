<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("auth")->group(function (){
    Route::prefix("register")->group(function (){
        Route::post("student",[\App\Http\Controllers\AuthController::class,"registerStudent"])->name("auth.register.student");
        Route::post("teacher",[\App\Http\Controllers\AuthController::class,"registerTeacher"])->name("auth.register.teacher");
        Route::post("company",[\App\Http\Controllers\AuthController::class,"registerCompany"])->name("auth.register.company");
    });
    Route::post("verify",[\App\Http\Controllers\AuthController::class,"studentVerifyEmail"])->name("auth.verify");
    Route::post("login",[\App\Http\Controllers\AuthController::class,"login"])->name("auth.login");
    Route::get("logout",[\App\Http\Controllers\AuthController::class,"logout"])->middleware("auth")->name("auth.logout");
    Route::get("refresh",[\App\Http\Controllers\AuthController::class,"refresh"])->middleware("auth")->name("auth.refresh");
    Route::get("unauthorized",[\App\Http\Controllers\AuthController::class,"unauthenticated"])->name("auth.unauthorized");
});

Route::get("lists",[\App\Http\Controllers\Controller::class,"getLists"])->name("list");

Route::prefix("lessons")->group(function (){
    Route::post("/",[\App\Http\Controllers\LessonController::class,"index"])->name("lessons.index");
    Route::get("filters",[\App\Http\Controllers\LessonController::class,"filters"])->name("lessons.filters");
    Route::get("{id}",[\App\Http\Controllers\LessonController::class,"show"])->name("lessons.show");
    Route::get("{id}/sign_up",[\App\Http\Controllers\LessonController::class,"sign_up"])->name("lessons.sign_up")
    ->middleware("auth");
});

Route::prefix("courses")->group(function (){
    Route::post("/",[\App\Http\Controllers\CoursesController::class,"index"])->name("courses.index");
    Route::get("filters",[\App\Http\Controllers\CoursesController::class,"filters"])->name("courses.filters");
    Route::get("{id}",[\App\Http\Controllers\CoursesController::class,"show"])->name("courses.show");
    Route::get("{id}/sign_up",[\App\Http\Controllers\CoursesController::class,"sign_up"])->name("courses.sign_up")
        ->middleware("auth");
});

Route::prefix("forum")->group(function (){
    Route::get("/",[\App\Http\Controllers\Forum\ForumController::class,"index"]);
    Route::prefix("{forum_id}")->group(function (){
        Route::get("/",[\App\Http\Controllers\Forum\ForumController::class,"forum"]);
        Route::post("/",[\App\Http\Controllers\Forum\ForumController::class,"create_theme"]);
        Route::prefix("{theme_id}")->group(function (){
            Route::get("/",[\App\Http\Controllers\Forum\ForumController::class,"theme"]);
            Route::post("/",[\App\Http\Controllers\Forum\ForumController::class,"message"])
                ->middleware("auth");
        });
    });
});

Route::prefix("teachers")->group(function (){
    Route::get("all",[\App\Http\Controllers\TeacherController::class,"all"]);
    Route::post("/",[\App\Http\Controllers\TeacherController::class,"index"]);
    Route::get("{id}",[\App\Http\Controllers\TeacherController::class,"show"]);
});

Route::prefix("image")->group(function (){
    Route::post("avatar",[\App\Http\Controllers\ImageController::class,"avatar"])->name("image.avatar");
    Route::post("diploma",[\App\Http\Controllers\ImageController::class,"diploma"])->name("image.diploma");
    Route::post("lesson",[\App\Http\Controllers\ImageController::class,"lesson"])->name("image.lesson");
});

Route::middleware("auth")->group(function (){
    Route::middleware(['hasRole:'.\App\Models\User::ROLE_TEACHER.','.\App\Models\User::ROLE_COMPANY])->prefix("students")->group(function (){
        Route::get("/",[\App\Http\Controllers\StudentsController::class,"index"])->name("students.index");
    });
    Route::prefix("profile")->group(function (){
        Route::prefix("teacher")->middleware('hasRole:'.\App\Models\User::ROLE_TEACHER)->group(function (){
            Route::get("/",[\App\Http\Controllers\Profile\Teacher\TeacherProfileController::class,"index"])->name("profile.teacher.index");
            Route::post("account",[\App\Http\Controllers\Profile\Teacher\TeacherProfileController::class,"updateAccount"])->name("profile.teacher.account");
            Route::post("info",[\App\Http\Controllers\Profile\Teacher\TeacherProfileController::class,"updateInfo"])->name("profile.teacher.info");
            Route::prefix("lesson")->group(function (){
                Route::post("/",[\App\Http\Controllers\Profile\Teacher\TeacherLessonController::class,"store"])->name("profile.teacher.lesson.store");
                Route::prefix("{id}")->group(function (){
                    Route::get("/",[\App\Http\Controllers\Profile\Teacher\TeacherLessonController::class,"show"])->name("profile.teacher.lesson.show");
                    Route::put("/",[\App\Http\Controllers\Profile\Teacher\TeacherLessonController::class,"update"])->name("profile.teacher.lesson.update");
                    Route::prefix("students")->group(function (){
                        Route::post("/",[\App\Http\Controllers\Profile\Teacher\TeacherLessonController::class,"student_add"])->name("profile.teacher.lesson.students.add");
                        Route::delete("{student_id}",[\App\Http\Controllers\Profile\Teacher\TeacherLessonController::class,"student_delete"])->name("profile.teacher.lesson.students.delete");
                    });
                });
            });
        });
        Route::prefix("company")->middleware('hasRole:'.\App\Models\User::ROLE_COMPANY)->group(function (){
            Route::get("/",[\App\Http\Controllers\Profile\Company\CompanyProfileController::class,"index"])->name("profile.company.index");
            Route::post("account",[\App\Http\Controllers\Profile\Company\CompanyProfileController::class,"updateAccount"])->name("profile.company.account");
            Route::post("info",[\App\Http\Controllers\Profile\Company\CompanyProfileController::class,"updateInfo"])->name("profile.company.info");
            Route::prefix("lesson")->group(function (){
                Route::post("/",[\App\Http\Controllers\Profile\Company\CompanyLessonController::class,"store"])->name("profile.company.lesson.store");
                Route::prefix("{id}")->group(function (){
                    Route::get("/",[\App\Http\Controllers\Profile\Company\CompanyLessonController::class,"show"])->name("profile.company.lesson.show");
                    Route::put("/",[\App\Http\Controllers\Profile\Company\CompanyLessonController::class,"update"])->name("profile.company.lesson.update");
                    Route::prefix("students")->group(function (){
                        Route::post("/",[\App\Http\Controllers\Profile\Company\CompanyLessonController::class,"student_add"])->name("profile.company.lesson.students.add");
                        Route::delete("{student_id}",[\App\Http\Controllers\Profile\Company\CompanyLessonController::class,"student_delete"])->name("profile.company.lesson.students.delete");
                    });
                });
            });
            Route::prefix("course")->group(function (){
                Route::post("/",[\App\Http\Controllers\Profile\Company\CompanyCourseController::class,"store"])->name("profile.company.course.store");
                Route::prefix("{id}")->group(function (){
                    Route::get("/",[\App\Http\Controllers\Profile\Company\CompanyCourseController::class,"show"])->name("profile.company.course.show");
                    Route::put("/",[\App\Http\Controllers\Profile\Company\CompanyCourseController::class,"update"])->name("profile.company.course.update");
                    Route::prefix("students")->group(function (){
                        Route::post("/",[\App\Http\Controllers\Profile\Company\CompanyCourseController::class,"student_add"])->name("profile.company.course.students.add");
                        Route::delete("{student_id}",[\App\Http\Controllers\Profile\Company\CompanyCourseController::class,"student_delete"])->name("profile.company.course.students.delete");
                    });
                    Route::put("plan",[\App\Http\Controllers\Profile\Company\CompanyCourseController::class,"plan"])->name("profile.company.course.plan.update");
                });
            });
        });
        Route::prefix("student")->middleware('hasRole:'.\App\Models\User::ROLE_STUDENT)->group(function (){
            Route::get("/",[\App\Http\Controllers\Profile\Student\StudentProfileController::class,"index"])->name("profile.student.index");
            Route::post("account",[\App\Http\Controllers\Profile\Student\StudentProfileController::class,"updateAccount"])->name("profile.student.account");
            Route::post("info",[\App\Http\Controllers\Profile\Student\StudentProfileController::class,"updateInfo"])->name("profile.student.info");
        });
    });
});
