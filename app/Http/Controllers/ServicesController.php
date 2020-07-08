<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppModels\Services;
use App\Models\AppModels\SiteSettings;

class ServicesController extends Controller
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
        //$services = Services::where(['companyId' => $company->companyId])->get();
        $services = Services::all();
        error_log('->ServicesController is : ');
        return view('appPages.services.index')->with('services',$services);
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
            'description'=>'required'
            //'cover_image'=>'image|nullable|max:1999'
        ]);

        $host = $request->getHttpHost();
        error_log('->Host is : '.$host);
        $company = SiteSettings::find(1)->where('sValue', $host)->first();
        //auth()->user()->id;
        // Creating Post
        $service = new Services;
        $service->title = $request->input('title');
        $service->description = $request->input('description');
        $service->icon = $request->input('icon');
        $service->com_id = $company->companyId;
        //$service->user_id = auth()->user()->id;
        //$service->cover_image = $filenameToStore;
        $service->save();
        return redirect('/app/services')->with('success', 'Service Created');
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
        $service = Services::find($id);
        error_log('->ServicesController edit : '.$id);
        error_log('->ServicesController edit : '.$service->title);
        return response()->json(['service'=>$service]);
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
        $service = Services::find($id);
        error_log('->ServicesController edit : '.$id);
        error_log('->ServicesController edit : '.$service->title);
        $item = $service->title;
        $service->delete();

        return redirect('/app/services')->with('success', $item.' Service is Successfully Deleted!');
    }
}
