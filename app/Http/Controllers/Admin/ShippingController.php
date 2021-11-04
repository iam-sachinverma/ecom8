<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use Session;

class ShippingController extends Controller
{
    public function viewShippingCharges(){
        Session::put('page','shipping_charges');
        $shipping_charges = ShippingCharge::get()->toArray();
        // dd($shipping_charges);
        return view('admin.shipping.view_shipping_charges')->with(compact('shipping_charges'));
    }

    public function editShippingCharges($id, Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            if(empty($data['COD'])){
                $cod = "No";
            }else{
                $cod = "Yes";
            }

            ShippingCharge::where('id',$id)->update([
                '0_500gm'=>$data['0_500gm'],
                '501_1000gm'=>$data['501_1000gm'],
                '1001_2000gm'=>$data['1001_2000gm'],
                '2001_5000gm'=>$data['2001_5000gm'],
                'above_5000gm'=>$data['above_5000gm'],
                'COD'=>$cod
            ]);
            $message = "Shipping Charges Updated Successfully";
            Session::flash('success_message',$message);
            return redirect()->back();
        }
        $shippingDetails = ShippingCharge::where('id',$id)->first()->toArray();
        // dd($shippingDetails); die;
        return view('admin.shipping.edit_shipping_charges')->with(compact('shippingDetails'));
    }

    public function updateShippingStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ShippingCharge::where('id',$data['shipping_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'shipping_id'=>$data['shipping_id']]);
        }
    }
}
