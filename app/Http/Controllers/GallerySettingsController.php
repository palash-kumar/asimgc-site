<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\AppModels\Gallery;
use App\Models\AppModels\ImageCategory;
use App\Models\AppModels\SiteSettings;
use Yajra\DataTables\DataTables;

use Session;

class GallerySettingsController extends Controller
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
        $gallery = Gallery::all();
        $imageCategory = ImageCategory::all()->pluck('title', 'id')->toArray();
        $cats = ImageCategory::select('id','title')->get();//all()->pluck('title', 'id')->toArray();
        error_log('->GallerySettingsController is : '.$imageCategory[1].' request: '.$request->ajax());
        if ($request->ajax()) {
            error_log('->GallerySettingsController request: '.$request->ajax());
            $company = Session::get("company");
            //$users = User::with('userRole', 'designation', 'userServices');
            $gallery = Gallery::where(['com_id' => $company->companyId])->orderBy('status', 'ASC')->get();
            //error_log('$gallery: '.$gallery);
            return Datatables::of($gallery)->addColumn('cat', function(Gallery $gal){
                return $gal->imageCategory->title ;
            })->addColumn('cat_id', function(Gallery $gal){
                return $gal->imageCategory->id ;
            })->toJson();
        }
        return view('appPages.gallerySettings')->with('gallery',$gallery)->with(['imageCategory'=>$imageCategory, 'cats'=>$cats]);
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
            'image_cat'=>'required',
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
            $path = $request->file('cover_image')->storeAs('public/siteImages/Gallery', $filenameToStore);
        }else{
            error_log('->cover_image is NULL ');
            $filenameToStore = "noImage.jpg";
        }
        $host = $request->getHttpHost();
        error_log('->Host is : '.$host);
        $company = SiteSettings::find(1)->where('sValue', $host)->first();

        $gallery = new Gallery;//::find($id);

        $gallery->title = $request->input('title');
        $gallery->description = $request->input('description');
        $gallery->detail = $request->input('detail');
        $gallery->image_category_id = $request->input('image_cat');
        $gallery->image_path = $filenameToStore;
        $gallery->com_id = $company->companyId;
        error_log('->Host is : '.$gallery->image_type);
        $gallery->save();

        return redirect('/app/gallery')->with('success', 'Image saved Successfully');
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
        $gallery = Gallery::find($id);

        return response()->json(['gallery'=>$gallery]);
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
            'ecover_image'=>'image|nullable|max:1999'
        ]);

        $gallery = Gallery::find($id);
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
            $path = $request->file('ecover_image')->storeAs('public/siteImages/Gallery', $filenameToStore);

            // Deleting the old file
            if($gallery->image_path != 'noImage.jpg'){
                // Delete Image
                Storage::delete('public/siteImages/Gallery/'.$gallery->image_path);
            }
        }



        $gallery->title = $request->input('etitle');
        $gallery->description = $request->input('edescription');
        $gallery->detail = $request->input('edetail');
        if($request->hasFile('ecover_image')){
            $gallery->image_path = $filenameToStore;
        }
        error_log('->Host is : '.$gallery->image_type);
        $gallery->save();

        return redirect('/app/gallery')->with('success', 'Information Updated For '.$gallery->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        // Check for the correct user
        /*if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Un-authorized Page!');
        }*/

        if($gallery->image_path != 'noImage.jpg'){
            // Delete Image
            Storage::delete('public/siteImages/Gallery/'.$gallery->image_path);
        }
        $item = $gallery->title;
        $gallery->delete();

        return redirect('/app/gallery')->with('success', $item.' is successfully deleted.');
    }

    public function updateImageCategory(Request $request, $id){

        $gallery = Gallery::find($id);
        $gallery->image_category_id = $request->input('category');
        $gallery->save();

        return redirect('/app/gallery')->with('success', 'Image Category Updated For '.$gallery->title);
    }

    public function galleryLs(){
        $company = Session::get("company");
        $gallery = Gallery::where(['com_id' => $company->companyId])->orderBy('status', 'ASC')->get();
        return DataTables::of($gallery)->toJson();
    }
}
