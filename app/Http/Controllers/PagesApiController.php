<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\CustomModels\Response;
use App\Models\AppModels\Projects;
use App\Models\AppModels\Clients;
use Session;

class PagesApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['projectList', 'getProjectDetails', 'clientList', '', 'clients', 'commitments', 'commitments']]);
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
}
