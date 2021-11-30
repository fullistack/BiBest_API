<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentVerifyEmailRequest;
use App\Http\Requests\TeacherStoreRequest;
use App\Jobs\EmailsJob;
use App\Mail\StudentRegisterConfirm;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    function registerStudent(StudentStoreRequest $request)
    {
        $user_data = $request->only("name", "email", "password");
        $token = Str::random(16);
        $user_data['remember_token'] = $token;
        $user = User::create($user_data);
        $user->student()->create();
        Mail::to($user->email)->send(new StudentRegisterConfirm(['name' => $user->name, "token" => $token]));
        return $this->response(true);
    }

    function registerTeacher(TeacherStoreRequest $request)
    {
        $user_data = $request->only("name", "email", "password", "phone");
        $user = User::create($user_data);
        $teacher_data = $request->only("avatar", "passport", "country_iso", "city", "address");
        $teacher = $user->teacher()->create($teacher_data);
        $diplomas = $request->get("diplomas", []);
        foreach ($diplomas as $diploma) {
            $teacher->diplomas()->create(['diploma' => $diploma]);
        }
        $educations = $request->get("educations", []);
        foreach ($educations as $education) {
            $teacher->educations()->create(['education' => $education]);
        }
        $experiences = $request->get("experiences", []);
        foreach ($experiences as $experience) {
            $teacher->experiences()->create(['experience' => $experience]);
        }
        return $this->response(true);
    }

    function registerCompany(CompanyStoreRequest $request)
    {
        $user_data = $request->only("name", "email", "password", "phone");
        $user = User::create($user_data);
        $company_data = $request->only("title", "inn", "country_iso", "city", "address", "post");
        $user->company()->create($company_data);
        return $this->response(true);
    }

    function studentVerifyEmail(StudentVerifyEmailRequest $request)
    {
        $remember_token = $request->get("token");
        $user = User::query()->where("remember_token", $remember_token)->firstOrFail();
        $user->email_verified_at = Carbon::now();
        $user->remember_token = null;
        $user->save();
        Auth::login($user);
        $token = auth()->refresh();
        $output = [
            "token" => $token,
            "role"  => Auth::user()->role()
        ];
        return $this->response($output);
    }

    public function login(Request $request)
    {
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $credentials = [
            $fieldType => $request->email,
            "password" => $request->password,
        ];
        if (!$token = auth()->attempt($credentials)) {
            return $this->unauthenticated();
        }
        $output = [
            "token" => $token,
            "role"  => Auth::user()->role()
        ];
        return $this->response($output);
    }

    public function logout()
    {
        auth()->logout();
        return $this->response(true);
    }

    public function refresh()
    {
        $token = auth()->refresh();
        return $this->response($token);
    }

    public function unauthenticated()
    {
        return $this->response('Unauthorized', 401);
    }
}
