<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use Session;
use Validator;

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

    public function contact(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            // Validation left
            // Send Mail
            $email = "sachinvermab@gmail.com";
            $messageData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'subject' => $data['subject'],
                'comment' => $data['comment']
            ];
            
            Mail::send('emails.enquiry',$messageData,function($message) use($email){
                $message->to($email)->subject('Enquiry Contact us');
            });

            $message = "Thanks for contact us, we will get back to you soon";
            session::flash('success_message',$message);
            return redirect()->back();
        }

        return view('front.pages.contact');
    }
    
}
