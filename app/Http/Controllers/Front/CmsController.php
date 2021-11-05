<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;

class CmsController extends Controller
{
    public function cmsPage(){
        $domain_url = request()->getSchemeAndHttpHost();
        $currentRoute = url()->current();
        $currentRoute = str_replace($domain_url."/","",$currentRoute);
        $cmsRoutes = CmsPage::where('status',1)->get()->pluck('url')->toArray();
        // dd($cmsRoutes); die;
        if(in_array($currentRoute,$cmsRoutes)){
            $cmsPageDetails = CmsPage::where('url',$currentRoute)->first()->toArray();
            return view('front.pages.cms_page')->with(compact('cmsPageDetails'));
        }else{
            abort(404);
        }
    }
}
