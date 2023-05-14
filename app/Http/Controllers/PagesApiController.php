<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\CustomModels\Response;
use App\Models\AppModels\Projects;
use App\Models\AppModels\Clients;
use App\Models\AppModels\Gallery;
use Session;

class PagesApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['projectList', 'getProjectDetails', 'clientList', 'galleryImages', 'clients', 'commitments', 'commitments']]);
    }


    public function clientList(){
        error_log("clientList called..");
        $company = Session::get("company");
        //$requests=Requests::where('area_id','=', $companySettigs->com_id)->orderByDesc ('id')->with(['com', 'reqInfos', 'reqInfos.app', 'reqInfos.pack'])->get();
        $clients = Clients::select( 'title', 'description', 'image_path')->where(['com_id' => $company->companyId])->orderBy('status', 'ASC')->get();
        error_log("clientList called..".$company->companyId);
        return response()->json($clients);
    }

    public function projectList(){
        error_log("projectList called..");
        $company = Session::get("company");
        //$requests=Requests::where('area_id','=', $companySettigs->com_id)->orderByDesc ('id')->with(['com', 'reqInfos', 'reqInfos.app', 'reqInfos.pack'])->get();
        $projects = Projects::where(['com_id' => $company->companyId])->orderBy('projectStatus', 'ASC')->get();
        return DataTables::of($projects)->toJson();
    }

    public function getProjectDetails(Request $request){
        error_log("getProjectDetails called..".$request->input('project'));
        $company = Session::get("company");
        //$requests=Requests::where('area_id','=', $companySettigs->com_id)->orderByDesc ('id')->with(['com', 'reqInfos', 'reqInfos.app', 'reqInfos.pack'])->get();
        $project = Projects::select('proj_id', 'title', 'type', 'description','year', 'month', 'clientName', 'mainContractor','consultant','subContractor', 'projectStatus',)->where(['com_id' => $company->companyId, 'proj_id' => $request->input('project')])->first();
        return response()->json($project);
    }

    public function galleryImages(Request $request){
        $company = Session::get("company");
        $data = array( );
        error_log('url: '.$request->get('page'));

        $certificates = Gallery::select('image_path')->where(['com_id' =>$company->companyId])
                        ->with('imageCategory')
                        ->whereHas('imageCategory', function($query)  {// use ($term)
                        $query->where('tagName', 'certificates');
                        })->Where(['status' => true])->get();

        error_log('->Host is : '.count($certificates));
        $data['certificates'] = $certificates;

        // Only Front gallery and gallery where **Front** gallery contains images for displaying in main page
        if($request->get('page')=='index'){
            $gallery = Gallery::select('image_path')->where(['com_id' =>$company->companyId])
            ->with('imageCategory')
            ->whereHas('imageCategory', function($query)  {// use ($term)
            $query->Where(['tagName' => 'frontGalery']);
            })->get();

            $data['gallery'] = $gallery;
        }else{
            $gallery = Gallery::select('image_path')->where(['com_id' =>$company->companyId])
            ->with('imageCategory')
            ->whereHas('imageCategory', function($query)  {// use ($term)
            $query->where('tagName', 'gallery')->orWhere(['tagName' => 'frontGalery']);
            })->get();

            $data['gallery'] = $gallery;
        }


        return response()->json($data);
    }
}
