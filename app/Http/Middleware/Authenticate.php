<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Models\SiteModels\CompanySettings;
use App\Models\AppModels\SiteSettings;
use Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        $host = $request->getHttpHost();
        error_log('->Host is : '.$host);
        $company = SiteSettings::find(1)->where('sValue', $host)->first();
        $companySettigs = new CompanySettings;
        $companySettigs->com_id = $company->companyId;
        Session::put('companySettigs', $companySettigs);

        $siteSettings = SiteSettings::where('companyId', $company->companyId)->get();
        foreach ($siteSettings as $setting){
            switch ($setting->sName) {
                case 'NAME':
                    $companySettigs->title = $setting->sValue;
                    break;
                case 'LOGO':
                    $companySettigs->logo = $setting->sValue;
                    break;
                default:
                    
                    break;
            }
        }
        Session::put('companySettigs', $companySettigs);

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
