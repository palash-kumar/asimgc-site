<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\SiteModels\CompanySettings;

use App\Models\AppModels\SiteSettings;
use App\Models\AppModels\Services;
use App\Models\AppModels\Gallery;
use App\Models\AppModels\ImageCategory;
use App\Models\AppModels\Clients;
use App\Models\AppModels\Projects;

use App\Models\CustomModels\Helper;
use Session;
use DB;


class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'commitments', 'gallery', 'projects', 'commitments', 'commitments']]);
    }

    public function index(Request $request){
        $host = $request->getHttpHost();
        error_log('->Host is : '.$host);

        /**/
        $company = SiteSettings::find(1)->where('sValue', $host)->first();

        // Select * from SiteSettings where 'companyId' = 'asimgc-0813';
        $siteSettings = SiteSettings::where(['companyId' => $company->companyId])->get();//->pluck('companyId','asimgc-0813')->first();
       
        foreach ($siteSettings as $settings) {
            error_log('->siteSettings is : '.$settings.'\n');
        }

        $services = Services::where(['com_id' => $company->companyId])->get();
        $term = 'Commitment';
        //$imgCat = ImageCategory::where(['title' => 'like'. "%$term%" ])->get();//where(['title' => 'like', '%' . Input::get('name') . '%'])->get();
        
        $imgCats = ImageCategory::all();
        /*where(['tagName' => 'frontGalery'])
                                ->orWhere(['tagName' => 'certificates'])
                                ->orWhere(['tagName' => 'slider'])->get();*/
        $data = array(
            'siteSettings' => $siteSettings,
            'services' => $services

        );

        Session::put('services', $services);
        /*
        ,
            'commitments' => $commitments,
            'clients' => $clients,
            'galleryImages' => $galleryImages,
            'sliderImages' => $sliderImages
         */
        foreach ($imgCats as $imageCat) {
            $term = $imageCat->title;
            error_log('->imageCat is : '.$imageCat->tagName);
            $commitments = Gallery::where(['com_id' =>$company->companyId])
                        ->with('imageCategory')
                        ->whereHas('imageCategory', function($query) use ($term)  {
                        $query->where('title', $term);
                        })->get();
            
            $data[$imageCat->tagName] = $commitments;

            //error_log('->Slider is : '.$data[$imageCat->tagName]);
        }
        

        //error_log('count : '.count($commitments));

        $clients = Clients::where(['com_id' => $company->companyId, 'status' => TRUE])->get();
        error_log('count : '.count($clients));

        $data['clients'] = $clients;

        $projects = Projects::where(['com_id' => $company->companyId])->orderBy('projectStatus', 'ASC')->get();

        $projectsStatus = DB::table('projects')
                        ->select('projectStatus', DB::raw('count(*) as total'))
                        ->groupBy('projectStatus')
                        ->pluck('total','projectStatus')->all();

        $totalProjects=0;
        foreach($projectsStatus as $key => $value){
            error_log('->Projects is : '.$key.' -value '.$value);
            $totalProjects+=$value;
        }

        $data['projects'] = $projects;
        $data['projectsStatus'] = $projectsStatus;
        $data['totalProjects'] = $totalProjects;
        /*whereHas('sValue', function (Builder $query) {
            $query->where('sValue', 'like', $host);
        })->get();
        */
        
        return view('pages.index')->with($data);
    }

    public function commitments(Request $request){
        $host = $request->getHttpHost();
        error_log('->Host is : '.$host);

        /**/
        $company = SiteSettings::find(1)->where('sValue', $host)->first();
        
        $companySettings = new CompanySettings;
        $companySettings->title =  "Our Commitments";;
        $companySettings->description = 'This is test for setting and getting values from model';
        $uuid = Str::uuid();

        $term = 'Commitment';
        $commitments = Gallery::where(['com_id' =>$company->companyId])
                        ->with('imageCategory')
                        ->whereHas('imageCategory', function($query) use ($term)  {
                        $query->where('title', $term);
                        })->get();

        error_log('->->uuid is : '.$uuid);
        return view('pages.commitment')->with('commitments',$commitments)->with('companySettings',$companySettings);
    }

    public function gallery(Request $request){
        //error_log('->->gallery is : '.$request->getHttpHost());
        
        $company = Session::get("company");
        if($company == null){
            $helper = new Helper();
            $helper->getSettings($request);
        }

        $company = Session::get("company");

        $data = array( );

        //$term = "certificates";
        // Only Certificates
        $certificates = Gallery::where(['com_id' =>$company->companyId])
                        ->with('imageCategory')
                        ->whereHas('imageCategory', function($query)  {// use ($term)
                        $query->where('tagName', 'certificates');
                        })->Where(['status' => true])->get();
        
        error_log('->Host is : '.count($certificates));
        $data['certificates'] = $certificates;
        
        // Only Front gallery and gallery where **Front** gallery contains images for displaying in main page 
        $gallery = Gallery::where(['com_id' =>$company->companyId])
                        ->with('imageCategory')
                        ->whereHas('imageCategory', function($query)  {// use ($term)
                        $query->where('tagName', 'gallery')->orWhere(['tagName' => 'frontGalery']);
                        })->get();

        $data['gallery'] = $gallery;

        

        $title = "Gallery";
        return view('pages.gallery')->with("title", $title)->with($data);
    }

    public function projects(Request $request){
        $host = $request->getHttpHost();
        error_log('->Host is : '.$host);
        $title = "Our Projects!";

        /**/
        $company = SiteSettings::find(1)->where('sValue', $host)->first();

        //orderBy('id', 'DESC')->get();
        $projects = Projects::where(['com_id' => $company->companyId])->orderBy('projectStatus', 'ASC')->get();

        $projectsStatus = DB::table('projects')
                        ->select('projectStatus', DB::raw('count(*) as total'))
                        ->groupBy('projectStatus')
                        ->pluck('total','projectStatus')->all();

        $totalProjects=0;
        foreach($projectsStatus as $key => $value){
            error_log('->Projects is : '.$key.' -value '.$value);
            $totalProjects+=$value;
        }
        $data = array( );
        $data['title'] = $title;
        $data['projects'] = $projects;
        $data['projectsStatus'] = $projectsStatus;
        $data['totalProjects'] = $totalProjects;

        
        return view('pages.projects')->with($data);
    }



    public function developmentTest(Request $request){
        $host = $request->getHttpHost();
        error_log('->Host is : '.$host);

        /**/
        $company = SiteSettings::find(1)->where('sValue', $host)->first();

        // Select * from SiteSettings where 'companyId' = 'asimgc-0813';
        $siteSettings = SiteSettings::where(['companyId' => $company->companyId])->get();//->pluck('companyId','asimgc-0813')->first();
       
        foreach ($siteSettings as $settings) {
            error_log('->siteSettings is : '.$settings.'\n');
        }

        $services = Services::where(['com_id' => $company->companyId])->get();
        $term = 'Commitment';
        //$imgCat = ImageCategory::where(['title' => 'like'. "%$term%" ])->get();//where(['title' => 'like', '%' . Input::get('name') . '%'])->get();
        
        $imgCats = ImageCategory::all();
        /*where(['tagName' => 'frontGalery'])
                                ->orWhere(['tagName' => 'certificates'])
                                ->orWhere(['tagName' => 'slider'])->get();*/
        $data = array(
            'siteSettings' => $siteSettings,
            'services' => $services

        );

        Session::put('services', $services);
        /*
        ,
            'commitments' => $commitments,
            'clients' => $clients,
            'galleryImages' => $galleryImages,
            'sliderImages' => $sliderImages
         */
        foreach ($imgCats as $imageCat) {
            $term = $imageCat->title;
            error_log('->imageCat is : '.$imageCat->tagName);
            $commitments = Gallery::where(['com_id' =>$company->companyId])
                        ->with('imageCategory')
                        ->whereHas('imageCategory', function($query) use ($term)  {
                        $query->where('title', $term);
                        })->get();
            
            $data[$imageCat->tagName] = $commitments;

            //error_log('->Slider is : '.$data[$imageCat->tagName]);
        }
        

        //error_log('count : '.count($commitments));

        $clients = Clients::where(['com_id' => $company->companyId, 'status' => TRUE])->get();
        error_log('count : '.count($clients));

        $data['clients'] = $clients;

        $projects = Projects::where(['com_id' => $company->companyId])->orderBy('projectStatus', 'ASC')->get();

        $projectsStatus = DB::table('projects')
                        ->select('projectStatus', DB::raw('count(*) as total'))
                        ->groupBy('projectStatus')
                        ->pluck('total','projectStatus')->all();

        $totalProjects=0;
        foreach($projectsStatus as $key => $value){
            error_log('->Projects is : '.$key.' -value '.$value);
            $totalProjects+=$value;
        }

        $data['projects'] = $projects;
        $data['projectsStatus'] = $projectsStatus;
        $data['totalProjects'] = $totalProjects;
        /*whereHas('sValue', function (Builder $query) {
            $query->where('sValue', 'like', $host);
        })->get();
        */
        
        
        $title = "Our Projects!";
        return view('pages.dev')->with($data);
    }
}
