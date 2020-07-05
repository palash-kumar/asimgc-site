<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\AppModels\SiteSettings;
use App\Models\AppModels\Clients;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Clients::all();
        //User::all()->random(10); // The amount of items you wish to receive
        return view('appPages.clientsSettings')->with('clients',$clients);
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
            'cover_image'=>'image|required|max:1999'
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
            $path = $request->file('cover_image')->storeAs('public/siteImages/Clients', $filenameToStore);
        }else{
            error_log('->cover_image is NULL ');
            $filenameToStore = "noImage.jpg";
        }
        $host = $request->getHttpHost();
        error_log('->Host is : '.$host);
        $company = SiteSettings::find(1)->where('sValue', $host)->first();

        $clients = new Clients;//::find($id);
        
        $clients->title = $request->input('title');
        $clients->description = $request->input('description');
        $clients->image_path = $filenameToStore;
        $clients->com_id = $company->companyId;
        $clients->save();

        return redirect('/clients')->with('success', 'Clients Info saved Successfully');
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
        $clients = Clients::find($id);

        return response()->json(['clients'=>$clients]);
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
        
        $clients = Clients::find($id);
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
            $path = $request->file('ecover_image')->storeAs('public/siteImages/Clients', $filenameToStore);

            // Deleting the old file
            if($clients->image_path != 'noImage.jpg'){
                // Delete Image
                Storage::delete('public/siteImages/Clients/'.$clients->image_path);
            }
        }

        
        
        $clients->title = $request->input('etitle');
        $clients->description = $request->input('edescription');
        if($request->hasFile('ecover_image')){
            $clients->image_path = $filenameToStore;
        }
        $clients->save();

        return redirect('/clients')->with('success', 'Information Updated For '.$clients->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clients = Clients::find($id);
        // Check for the correct user
        /*if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Un-authorized Page!');
        }*/

        if($clients->image_path != 'noImage.jpg'){
            // Delete Image
            Storage::delete('public/siteImages/Clients/'.$clients->image_path);
        }
        $item = $clients->title;
        $clients->delete();

        return redirect('/clients')->with('success', $item.' is successfully deleted.');
    }

    public function updateStatus(Request $request, $id){

        $clients = Clients::find($id);
        if($clients->status)
            $clients->status = FALSE;
        else
            $clients->status = TRUE;

        $clients->save();

        return response()->json(['clients'=>$clients]);
    }
}
