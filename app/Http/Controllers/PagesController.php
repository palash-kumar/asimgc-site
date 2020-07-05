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

class PagesController extends Controller
{
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

        $data = array(
            'siteSettings' => $siteSettings,
            'services' => $services

        );

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
        }
        

        //error_log('count : '.count($commitments));

        $clients = Clients::where(['com_id' => $company->companyId, 'status' => TRUE])->get();
        error_log('count : '.count($clients));

        $data['clients'] = $clients;
        /*whereHas('sValue', function (Builder $query) {
            $query->where('sValue', 'like', $host);
        })->get();
        */
        //error_log('->siteSettings is : '.$siteSettings->sValue);
        

        $title = "Welcome to Laravel!";
        
        return view('pages.index')->with($data);
    }

    public function commitments(){
        $companySettings = new CompanySettings;
        $companySettings->title =  "Our Commitments";;
        $companySettings->description = 'This is test for setting and getting values from model';
        $uuid = Str::uuid();
        error_log('->->uuid is : '.$uuid);
        return view('pages.commitment')->with('companySettings',$companySettings);
    }

    public function gallery(){
        $title = "Our Gallery!";
        return view('pages.gallery', compact('title'));
    }

    public function projects(){
        $title = "Our Projects!";
        return view('pages.projects', compact('title'));
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

        $data = array(
            'siteSettings' => $siteSettings,
            'services' => $services

        );

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
        /*whereHas('sValue', function (Builder $query) {
            $query->where('sValue', 'like', $host);
        })->get();
        */
        
        
        $title = "Our Projects!";
        return view('pages.dev')->with($data);
    }
}
