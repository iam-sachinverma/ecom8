<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartSetting;
use Session;

class CartController extends Controller
{
    // Cart Max and Min Value
    public function updateOtherSettings(Request $request){
        Session::put('page','update-other-settings');
        $otherSettings = CartSetting::where('id',1)->first()->toArray();
        // dd($otherSettings); die;
        $title = "Cart Max and Min Value";
        if($request->isMethod('post')){
            $data = $request->all();
            CartSetting::where('id',1)->update(['min_cart_value'=>$data['min_cart_value'],
             'max_cart_value'=>$data['max_cart_value']]);
            $message = "Cart Value Update Succesfully";
            Session::flash('success_message',$message);
            return redirect()->back(); 
        }
        return view('admin.other_settings')->with(compact('title','otherSettings'));
    }
}
