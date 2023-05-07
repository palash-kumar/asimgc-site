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
use App\User;

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
        $this->middleware('auth', ['except'=>['index', 'commitments', 'gallery', 'projects', 'clients', 'commitments', 'commitments']]);
    }



    public function index(Request $request){

        // Checking Session
        Helper::checkSession($request);


        $company = Session::get("company");
        $companySettigs = Session::get("companySettigs");

        // error_log('->siteSettings is : '.$companySettigs->services.'\n');

        $term = 'Commitment';

        $imgCats = ImageCategory::all();

        $data = array(
            //'siteSettings' => $siteSettings,
            'services' => $companySettigs->services

        );

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
        $users = User::whereNotNull('designations_id')->orderBy('designations_id','asc')->get();

        $data['projects'] = $projects;
        $data['projectsStatus'] = $projectsStatus;
        $data['totalProjects'] = $totalProjects;
        $data['users'] = $users;
        //$data['services'] = $companySettigs->services;

        return view('pages.index')->with($data);
    }

    public function commitments(Request $request){

        // Checking Session
        Helper::checkSession($request);

        $company = Session::get("company");
        $companySettigs = Session::get("companySettigs");

        $term = 'Commitment';
        $commitments = Gallery::where(['com_id' =>$company->companyId])
                        ->with('imageCategory')
                        ->whereHas('imageCategory', function($query) use ($term)  {
                        $query->where('title', $term);
                        })->get();

        //error_log('->->uuid is : '.$uuid);
        return view('pages.commitment')->with('commitments',$commitments);
    }

    public function gallery(Request $request){

        // Checking Session
        Helper::checkSession($request);

        $company = Session::get("company");
        $companySettigs = Session::get("companySettigs");

        $data = array( );

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

        // Checking Session
        Helper::checkSession($request);

        $company = Session::get("company");
        $companySettigs = Session::get("companySettigs");

        $title = "Our Projects!";

        //orderBy('id', 'DESC')->get();
        $projects = Projects::where(['com_id' => $company->companyId])->orderBy('projectStatus', 'ASC')->get();

        $projectsStatus = DB::table('projects')
                        ->select('projectStatus', DB::raw('count(*) as total'))
                        ->groupBy('projectStatus')
                        ->pluck('total','projectStatus')->all();

        $totalProjects=0;
        foreach($projectsStatus as $key => $value){
            error_log('->pages.index Projects is : '.$key.' -value '.$value);
            $totalProjects+=$value;
        }
        $data = array( );
        $data['title'] = $title;
        $data['projects'] = $projects;
        $data['projectsStatus'] = $projectsStatus;
        $data['totalProjects'] = $totalProjects;


        return view('pages.projects')->with($data);
    }



    public function clients(Request $request){

        // Checking Session
        Helper::checkSession($request);

        $company = Session::get("company");
        $companySettigs = Session::get("companySettigs");

        $title = "Clients";

        //orderBy('id', 'DESC')->get();
        $clients = Clients::where(['com_id' => $company->companyId])->get();
        //$clients = Clients::all();
        /*$projectsStatus = DB::table('projects')
                        ->select('projectStatus', DB::raw('count(*) as total'))
                        ->groupBy('projectStatus')
                        ->pluck('total','projectStatus')->all();*/


        $data = array( );
        $data['title'] = $title;
        $data['clients'] = $clients;


        return view('pages.clients')->with($data);
    }

    public function developmentTest(Request $request){
        // Checking Session
        Helper::checkSession($request);


        $company = Session::get("company");
        $companySettigs = Session::get("companySettigs");



        //$user = User::find(1)->where(['uuid' => auth()->user()->uuid])->first();
        //error_log("In developmentTest : ".$user->uuid);
        error_log("In developmentTest : ".auth()->user()->userRole->name);//services_id



        // Testing end


        $imgCats = ImageCategory::all();
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

        $users = User::whereNotNull('designations_id')->orderBy('designations_id','asc')->get();

        $data['projects'] = $projects;
        $data['projectsStatus'] = $projectsStatus;
        $data['totalProjects'] = $totalProjects;
        $data['services'] = Session::get("services");
        $data['users'] = $users;
        /*whereHas('sValue', function (Builder $query) {
            $query->where('sValue', 'like', $host);
        })->get();
        */


        $title = "Our Projects!";
        return view('pages.dev')->with($data);
    }
}
