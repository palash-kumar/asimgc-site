<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AppModels\SiteSettings;

class SiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = SiteSettings::all();
        error_log('->SiteSettingsController is : ');
        return view('appPages.siteSettings.index')->with('settings',$settings);
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
            'sName'=>'required',
            'cover_image'=>'image|nullable|max:1999'
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
            $path = $request->file('cover_image')->storeAs('public/siteImages/', $filenameToStore);
        }else{
            error_log('->cover_image is NULL ');
            $filenameToStore = "noImage.jpg";
        }
        $host = $request->getHttpHost();
        error_log('->Host is : '.$host);
        $company = SiteSettings::find(1)->where('sValue', $host)->first();

        $settings = new SiteSettings;//::find($id);
        $settings->companyId = $company->companyId;
        $settings->sName = $request->input('sName');
        $settings->sValue = $request->input('sValue');
        if($request->hasFile('cover_image')){
            $settings->sValue = $filenameToStore;
        }
        $settings->save();

        return redirect('/settings')->with('success', 'Settings saved Successfully');
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
        $setting = SiteSettings::find($id);
        error_log('->SiteSettingsController edit : '.$id);
        error_log('->SiteSettingsController edit : '.$setting->sName);
        return response()->json(['setting'=>$setting]);
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
            'esName'=>'required',
            'ecover_image'=>'image|nullable|max:1999'
        ]);

        error_log('->update ');

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
            $path = $request->file('ecover_image')->storeAs('public/siteImages/', $filenameToStore);
        }

        $settings = SiteSettings::find($id);
        $settings->sName = $request->input('esName');
        $settings->sValue = $request->input('esValue');
        if($request->hasFile('ecover_image')){
            $settings->sValue = $filenameToStore;
        }
        $settings->save();

        return redirect('/settings')->with('success', 'Settings UPDATED Successfully');
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

    /**
     * Update status of a settings.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        $setting = SiteSettings::find($id);
        error_log('->SiteSettingsController updateStatus : '.$id);
        error_log('->SiteSettingsController updateStatus : '.$setting->sName);
        if ($setting->status) {
            $setting->status = false;
        } else {
            $setting->status = true;
        }
        
        $setting->save();

        return response()->json(['setting'=>$setting]);
    }
}
