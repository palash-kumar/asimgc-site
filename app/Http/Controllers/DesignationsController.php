<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AppModels\Designations;
use App\Models\CustomModels\Helper;
use Session;
use DB;

class DesignationsController extends Controller
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

        $designations = Designations::all();
        error_log('->DesignationsController is : ');
        return view('appPages.designationSettings')->with('designations',$designations);
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
        // Checking Session
        Helper::checkSession($request);

        $this->validate($request,[
            'title'=>'required',
        ]);

        $company = Session::get("company");
        //auth()->user()->id;
        // Creating Post
        $designation = new Designations;
        $designation->title = $request->input('title');
        $designation->display_seq = $request->input('display_seq');
        $designation->com_id = $company->companyId;
        $designation->save();
        return redirect('/app/designations')->with('success', 'Designation Created');
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
        $designation = Designations::find($id);
        error_log('->DesignationsController edit : '.$id);
        error_log('->DesignationsController edit : '.$designation->title);
        return response()->json(['designation'=>$designation]);
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
            'etitle'=>'required'
        ]);
        
        $designation = Designations::find($id);
                
        
        $designation->title = $request->input('etitle');

        $designation->save();

        return redirect('/app/designations')->with('success', 'Information Updated For '.$designation->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $designation = Designations::find($id);
        error_log('->ServicesController edit : '.$id);
        error_log('->ServicesController edit : '.$service->title);
        $item = $designation->title;
        $designation->delete();

        return redirect('/app/designations')->with('success', $item.' Service is Successfully Deleted!');
    }

    

    public function updateStatus(Request $request, $id){

        $designation = Designations::find($id);
        if($designation->status)
            $designation->status = FALSE;
        else
            $designation->status = TRUE;

        $designation->save();

        return response()->json(['designation'=>$designation]);
    }

    public function updateDisplaySeq(Request $request, $id){

        $designation = Designations::find($id);
        $oldVal = $designation->display_seq;
        $designation->display_seq = $request->input('display_seq-'.$id);

        $designation->save();

        return redirect('/app/designations')->with('success', 'Display sequence is updated from '.$oldVal.' To '.$designation->display_seq);
    }
}
