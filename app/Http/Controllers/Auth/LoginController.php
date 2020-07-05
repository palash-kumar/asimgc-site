<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\AppModels\SiteSettings;
use App\Models\SiteModels\CompanySettings;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username'; //or return the field which you want to use.
    }

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function login(Request $request)

    {   

        $input = $request->all();
        if(Session::get('companySettigs') == null ){
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
        }
        

        $this->validate($request, [

            'username' => 'required',

            'password' => 'required',

        ]);

  

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))

        {

            return redirect()->route('home');

        }else{

            return redirect()->route('login')

                ->with('error','Email-Address And Password Are Wrong.');

        }

          

    }
}
