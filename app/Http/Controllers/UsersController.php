<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

use App\User;

use App\Models\CustomModels\Helper;

use App\Models\AppModels\UserRoles;
use App\Models\AppModels\Designations;
use App\Models\AppModels\Services;
use App\Models\AppModels\UserServices;
use Yajra\DataTables\DataTables;
use App\Models\CustomModels\Response;

use Session;
use DB;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Checking Session
        Helper::checkSession($request);

        $users = User::orderBy('designations_id','asc')->get();//->paginate(15);
        $designations = Designations::all();
        $roles = UserRoles::all();
        error_log('->UsersController is : ');
        $data = array(
            'users' => $users,
            'designations' => $designations,
            'roles' => $roles
        );

        if ($request->ajax()) {
            //$users = User::with('userRole', 'designation', 'userServices');
            $users = User::orderBy('designations_id','asc')->with('userRole', 'designation', 'userServices')->get();//User::select('*');
            return Datatables::of($users)->toJson();//make(true)
            /*return DataTables::eloquent($users)
                ->addColumn('users', function (Post $post) {
                    return $post->users->name;
                })
                ->toJson();*/
        }

        return view('appPages.usersSettings')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        error_log("uuid : ".$id);
        $uname = 'asim';
        $user = User::where('uuid', $id)->first();
        //error_log("user : ". Str::createUuidsUsing($id));
        return response()->json(['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus(Request $request, $id){

        $user = User::where('uuid', $id)->first();
        $msg = 'ACTIVE';
        if($user->status){
            $user->status = FALSE;
            $msg = 'INACTIVE';
        }
        else
            $user->status = TRUE;

        $user->save();
        return response()->json(Response::jsonResponse(200, 'success', $user->name.'\'s Status is Successfully updated to '.$msg, $user));
        //return response()->json(['user'=>$user]);
    }


    public function updateUserInfo(Request $request, $id){

        $user = User::where('uuid', $id)->first();

        error_log("mobile ".$request->input('emobile'));
        error_log("mobile ".$request->input('eemail'));
        //// Handle File Upload
        if($request->hasFile('user_image')){
            error_log('->user_image is NOT NULL ');
            // Get filename with extension
            $filenameWithExt = $request->file('user_image')->getClientOriginalName();
            // Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Just Get the Extension
            $extension  = $request->file('user_image')->getClientOriginalExtension();
            // Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('user_image')->storeAs('public/siteImages/UserImages', $filenameToStore);


            //if($user->user_image != $filenameToStore){
                if($user->image_path != 'noImage.jpg' || !empty($user->image_path)){
                    // Delete Image
                    Storage::delete('public/siteImages/UserImages/'.$user->user_image);
                }
            //}

        }else{
            error_log('->user_image is NULL ');
            $filenameToStore = "noImage.jpg";
        }


        if(!empty($request->input('emobile')))
            $user->mobile = $request->input('emobile');

        if(!empty($request->input('eemail')))
            $user->email = $request->input('eemail');

        if($request->hasFile('user_image')){
            $user->user_image = $filenameToStore;
        }
        $user->save();

        return redirect('/app/users')->with('success', 'User Information Successfully updated');
    }



    public function updateUserDesignation(Request $request, $id){

        $user = User::where('uuid', $id)->first();
        $user->designations_id = $request->input('desig');
        //error_log("mobile ".$request->input('desig-'.$id));

        $user->save();

        return response()->json(Response::jsonResponse(200, 'success', $user->name.'\'s Designation is Successfully updated to '.$user->designation->title, $user));
        //return redirect('/app/users')->with('success', $user->name.'\'s Designation is Successfully updated to '.$user->designation->title);
    }



    public function updateUserRole(Request $request, $id){

        $user = User::where('uuid', $id)->first();
        $user->user_roles_id = $request->input('role');
        error_log(">ROLE ".$request->input('role'));

        $user->save();

        return response()->json(Response::jsonResponse(200, 'success', $user->name.'\'s Role is Successfully updated to '.$user->userRole->name, $user));//redirect('/app/users')->with('success', $user->name.'\'s Role is Successfully updated to '.$user->userRole->name);
    }

    public function manageSkills(Request $request, $id){

        $user = User::where('uuid', $id)->first();
        $user->user_roles_id = $request->input('role-'.$id);

        $services = Services::all();
        //error_log("mobile ".$request->input('role-'.$id));
        $data = array(
            'user' => $user,
            'services' => $services
        );

        return view('appPages.userSkillsManagement')->with($data);
    }

    public function assignService(Request $request, $id){

        $user = User::where('uuid', $id)->first();

        error_log("assignService : ". $user->id." service : ".$request->service);

        $flag = false;
        $msg = "";
        $userService = UserServices::where([ "services_id" => $request->service])->where([ "user_id" => $user->id])->first(); // new UserServices();
        error_log("userService : ". $userService);
        if ($userService == null) {
            $userService = new UserServices();
            $userService->user_id = $user->id;
            $userService->services_id = $request->service;
            $userService->save();
            $flag = true;
            $msg = "Service is Successfully Assigned";
        } else {
            $msg = "Service is Successfully Removed from user.";
            $userService->delete();
        }

        $data = array(
            'flag' => $flag,
            'msg' => $msg,
            'user' => $user
        );

        /*if($user->status)
            $user->status = FALSE;
        else
            $user->status = TRUE;

        $user->save();*/

        return response()->json(['data'=>$data]);
    }
}
