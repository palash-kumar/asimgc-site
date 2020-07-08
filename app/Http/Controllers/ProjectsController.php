<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\AppModels\SiteSettings;
use App\Models\AppModels\Projects;

class ProjectsController extends Controller
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
    public function index()
    {
        $projects = Projects::all();
        $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
        $years = range(date('Y'), 1989);
        array_unshift($years, "Select year");
        array_unshift($months, "Select month");
        //User::all()->random(10); // The amount of items you wish to receive
        return view('appPages.projectsSettings')->with('projects',$projects)->with('months',$months)->with('years',$years);
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
        $this->validate($request,[
            'title'=>'required',
            'type'=>'required'
        ]);
        
        error_log('->cover_image is : '.$request->hasFile('cover_image'));
        //// Handle File Upload
        if($request->hasFile('cover_image')){
            error_log('->cover_image is NOT NULL ');
            // Get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Just Get the Extension
            $extension  = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/siteImages/Projects', $filenameToStore);
        }else{
            error_log('->cover_image is NULL ');
            $filenameToStore = "noImage.jpg";
        }
        $host = $request->getHttpHost();
        error_log('->Host is : '.$host);
        $company = SiteSettings::find(1)->where('sValue', $host)->first();

        $projects = new Projects;//::find($id);
        
        $projects->title = $request->input('title');
        $projects->type = $request->input('type');
        $projects->description = $request->input('description');
        $projects->year = $request->input('year');
        $projects->month = $request->input('month');
        $projects->endYear = $request->input('endYear');
        $projects->endMonth = $request->input('endMonth');
        $projects->clientName = $request->input('clientName');
        $projects->mainContractor = $request->input('mainContractor');
        $projects->consultant = $request->input('consultant');
        $projects->subContractor = $request->input('subContractor');
        error_log('->project Status : '.$request->has('projectStatus'));
        $projects->projectStatus = $request->has('projectStatus');
        $projects->status = $request->has('status');
        
        $projects->image_path = $filenameToStore;
        $projects->com_id = $company->companyId;
        $projects->save();

        return redirect('/app/projects')->with('success', 'Project Info saved Successfully');
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
        $projects = Projects::find($id);

        return response()->json(['projects'=>$projects]);
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
        $this->validate($request,[
            'etitle'=>'required',
            'edescription'=>'required',
            'ecover_image'=>'image|nullable|max:1999'
        ]);
        
        $projects = Projects::find($id);
        error_log('->cover_image is : '.$request->hasFile('ecover_image'));
        //// Handle File Upload
        if($request->hasFile('ecover_image')){
            error_log('->cover_image is NOT NULL ');
            // Get filename with extension
            $filenameWithExt = $request->file('ecover_image')->getClientOriginalName();
            // Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Just Get the Extension
            $extension  = $request->file('ecover_image')->getClientOriginalExtension();
            // Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('ecover_image')->storeAs('public/siteImages/Projects', $filenameToStore);

            // Deleting the old file
            if($projects->image_path != 'noImage.jpg'){
                // Delete Image
                Storage::delete('public/siteImages/Projects/'.$projects->image_path);
            }
        }

        
        
        $projects->title = $request->input('etitle');
        $projects->type = $request->input('etype');
        $projects->description = $request->input('edescription');
        $projects->year = $request->input('eyear');
        $projects->month = $request->input('emonth');
        $projects->endYear = $request->input('eendYear');
        $projects->endMonth = $request->input('eendMonth');
        $projects->clientName = $request->input('eclientName');
        $projects->mainContractor = $request->input('emainContractor');
        $projects->consultant = $request->input('econsultant');
        $projects->subContractor = $request->input('esubContractor');

        if($request->hasFile('ecover_image')){
            $projects->image_path = $filenameToStore;
        }
        $projects->save();

        return redirect('/app/projects')->with('success', 'Information Updated For '.$projects->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projects = Projects::find($id);
        // Check for the correct user
        /*if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Un-authorized Page!');
        }*/

        if($projects->image_path != 'noImage.jpg'){
            // Delete Image
            Storage::delete('public/siteImages/Projects/'.$projects->image_path);
        }
        $item = $projects->title;
        $projects->delete();

        return redirect('/app/projects')->with('success', $item.' is successfully deleted.');
    }

    public function updateStatus(Request $request, $id){

        $projects = Projects::find($id);
        if($projects->status)
            $projects->status = FALSE;
        else
            $projects->status = TRUE;

        $projects->save();

        return response()->json(['projects'=>$projects]);
    }

    public function updateProjectStatus(Request $request, $id){

        $projects = Projects::find($id);
        if($projects->projectStatus)
            $projects->projectStatus = FALSE;
        else
            $projects->projectStatus = TRUE;

        $projects->save();

        return response()->json(['projects'=>$projects]);
    }
}
