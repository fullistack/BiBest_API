<?php

namespace App\Http\Controllers\Profile\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyAccountUpdateRequest;
use App\Http\Requests\Company\CompanyInfoUpdateRequest;
use App\Http\Resources\CompanyProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    function index()
    {
        $company = Auth::user()->company;
        return $this->response(CompanyProfileResource::make($company));
    }

    function updateAccount(CompanyAccountUpdateRequest $request)
    {
        $company_data = $request->only("title", "logo");
        $user_data = $request->only("email", "phone", "password", "name");
        $user = Auth::user();
        $user->update($user_data);
        $user->company()->update($company_data);
        return $this->response(true);
    }

    function updateInfo(CompanyInfoUpdateRequest $request)
    {
        $user = Auth::user();

        $user_settings_data = $request->only("language_code", "time_zone");
        $company_info_data = $request->only( 'OGRN', 'organization_current_account', 'KPP', 'correspondent_bank_account', 'legal_address', 'BIK_bank', 'OKPO');
        $company_data = $request->only('country_iso','address');

        if ($company_data) {
            $user->company->update($company_data);
        }
        if ($user_settings_data) {
            $user->settings()->update($user_settings_data);
        }
        if ($company_info_data) {
            $user->company->info()->update($company_info_data);
        }


        return $this->response(true);
    }
}
