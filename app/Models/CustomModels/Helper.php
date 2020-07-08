<?php

namespace App\Models\CustomModels;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;
use App\Models\AppModels\SiteSettings;
use App\Models\AppModels\Services;

use Session;

class Helper extends Model
{
    public function getSettings(Request $request){
        error_log('-> Helper fucntion getSettings : '.$request->getHttpHost());
        $company = SiteSettings::find(1)->where('sValue', $request->getHttpHost())->first();

        $services = Services::where(['com_id' => $company->companyId])->get();
        Session::put('company', $company);
        Session::put('services', $services);
    }
}
