<?php

namespace App\Models\CustomModels;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;
use App\Models\AppModels\SiteSettings;
use App\Models\AppModels\Services;

use App\Models\SiteModels\CompanySettings;

use Session;

class Helper extends Model
{
    public static function checkSession(Request $request){
        error_log('-> checkSession  : ');
        /*==== Site Settings ====*/
        if(Session::get("company") == null || Session::get("companySettigs") == null || Session::get("services") == null ){ // When company sesion is null which is extreamely important
            error_log('-> checkSession helper : ');
            // getting all the required company settings
            self::getSettings($request);
        }
    }

    public static function getSettings(Request $request){
        error_log('-> Helper fucntion getSettings : '.$request->getHttpHost());
        // Getting primary company settings
        $company = SiteSettings::find(1)->where('sValue', $request->getHttpHost())->first();

        // Getting services
        $services = Services::where(['com_id' => $company->companyId])->get();
        Session::put('company', $company);
        Session::put('services', $services);

        // Getting company settings together
        $companySettigs = new CompanySettings;

        // Setting settings to object
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

        // Getting company services
        $services = Services::where(['com_id' => $company->companyId])->get();
        $companySettigs->services = $services;
        error_log('->siteSettings is : '.$companySettigs->services.'\n');
        
        Session::put('companySettigs', $companySettigs);

    }
    
}
