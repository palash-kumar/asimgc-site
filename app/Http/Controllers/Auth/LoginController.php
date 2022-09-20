<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\AppModels\SiteSettings;
use App\Models\SiteModels\CompanySettings;
use App\Models\AppModels\UserRoles;
use App\User;

use Session;

use App\Models\CustomModels\Helper;

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
        Helper::checkSession($request);


        $this->validate($request, [

            'username' => 'required',

            'password' => 'required',

        ]);



        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $userRoles = UserRoles::where(['status' => true])->get();
        //error_log("In LOGIN userRole : ".$userRole->id." - ".$userRole->name);

        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'], 'status' => 1)))

        {
            //getting role
            /*$term = 'Admin';
            // Testing to implement in LoginController
            $userLogin = User::find(1)->where(['uuid' => auth()->user()->uuid])
                                    ->with('userRole')
                                    ->whereHas('userRole', function($query) use ($term)  {
                                        $query->where('name', $term);
                                        })->first();
                                        */
            $authorized = false;

            foreach($userRoles as $role){
                error_log("In LOGIN userRole : ".$role->id." - ".$role->name);
                if(auth()->user()->user_roles_id == $role->id){
                    $authorized = true;
                    break;
                }
            }

            error_log("Login authorization state : ".$authorized);

            if($authorized){
                error_log("In LOGIN AFTER AUTHENTICATION PASS : ".auth()->user()->email);
                return redirect()->route('app/home');
            }else{
                error_log("Access Unauthorized: ");
                Auth::logout();
                return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
            }

        }else{

            return redirect()->route('login')

                ->with('error','Email-Address And Password Are Wrong.');

        }



    }

}
