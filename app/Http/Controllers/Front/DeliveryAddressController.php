<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL; 
use Illuminate\Support\Facades\Route;
use App\Models\DeliveryAddress;
use App\Models\PincodeArea;
use Auth;
use Redirect;
use Session;

class DeliveryAddressController extends Controller
{
 
    // Add Edit Delivery Address
    public function addEditDeliveryAddress($id=null,Request $request){

        if($id==""){
            // Add Delivery Addres
            $title = "Add Delivery Address";
            $address = new DeliveryAddress;
        }else{
            // Edit Delivery Address
            $title = "Edit Delivery Address";
            $address = DeliveryAddress::find($id);
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);

            $address->user_id = Auth::user()->id;
            $address->name = $data['name'];
            $address->mobile = $data['mobile'];
            $address->pincode = $data['pincode'];
            $address->district = $data['district'];
            $address->state = $data['state'];
            $address->address = $data['address'];
            $address->area = $data['area'];
            $address->landmark = $data['landmark'];    
            $address->address_type = $data['address_type'];
            $address->status = 1;
            $address->save();

        }

        return view('front.delivery_address.add_edit_delivery_address')->with(compact('title','address'));
    }

    // Delete Delivery Address
    public function deleteDeliveryAddress($id){
        DeliveryAddress::where('id',$id)->delete();
        $message = "Delivery Address deleted successfully";
        Session::flash('success_message',$message);
        return redirect('/account/address-book');
    }

    public function autofillAddress(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $getAddress = DeliveryAddress::getPincodeArea($data['pincode']);
            return $getAddress;
        }
    }


}
