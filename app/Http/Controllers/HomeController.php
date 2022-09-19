<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SiteModels\CompanySettings;

use App\Models\AppModels\SiteSettings;
use App\Models\AppModels\Services;
use App\Models\AppModels\Gallery;
use App\Models\AppModels\ImageCategory;
use App\Models\AppModels\Clients;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
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
        

        return view('home')->with($data);
    }
}
