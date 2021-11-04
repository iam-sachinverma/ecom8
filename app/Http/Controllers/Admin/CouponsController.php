<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Section;
use App\Models\User;
use Session;

class CouponsController extends Controller
{
    public function coupons(){
        Session::put('page','coupons');
        $coupons = Coupon::get()->toArray();
        return view('admin.coupons.coupons')->with(compact('coupons'));
    }

    public function addEditCoupon(Request $request, $id=null){
        if($id==""){
            // Add Coupon
            $title = "Add Coupon";
            $coupon = new Coupon;
            $selUsers = array();
            $message = "Coupon Added Successfully";
        }else{
            // Edit Coupon
    		$title = "Edit Coupon";
    		$coupon = Coupon::find($id);
            $selUsers = explode(',',$coupon['users']);
    		$message = "Coupon Updated Successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $rules = [
                'coupon_option' => 'required',
                'coupon_type' => 'required',
                'amount_type' => 'required',
                'amount' => 'required|numeric',
                'expiry_date' => 'required',
            ];
            $customMessages = [
                'coupon_option.required' => 'Please Select any Coupon Option',
                'coupon_type.required' => 'Please Select any Coupon Type',
                'amount_type.required' => 'Please Select any Amount Type',
                'amount.required' => 'Please Enter Amount',
                'amount.numeric' => 'Please Amount in Numbers Only',
                'expiry_date.required' => 'Please mention Coupon Expiry Date',
            ];
            $this->validate($request,$rules,$customMessages);


            if(isset($data['users'])){
                $users = implode(',',$data['users']);
            }else{
                $users = "";
            }
            // echo $users; die;
            
            if($data['coupon_option']=="Automatic"){
                $coupon_code = str_random(5);
            }else{
                if(empty($data['coupon_code'])){
                    $message = "Please Enter Your Manual Coupon Code";
                    session::flash('error_message', $message);
                    return redirect('admin/add-edit-coupon');
                }
                $coupon_code = $data['coupon_code'];
            }
            // echo $coupon_code; die;
            $coupon->coupon_option = $data['coupon_option'];
            $coupon->coupon_code = $coupon_code;
            $coupon->users = $users;
            $coupon->coupon_type = $data['coupon_type'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->amount = $data['amount'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = 1;
            $coupon->save();

            session::flash('success_message', $message);
            return redirect('admin/coupons');
            
        }

        // Users
        $users = User::select('email')->where('status',1)->get()->toArray();

        return view('admin.coupons.add_edit_coupon')->with(compact('title','coupon','users','selUsers'));
    }

    public function updateCouponStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Coupon::where('id',$data['coupon_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'coupon_id'=>$data['coupon_id']]);
        }
    }

    public function deleteCoupon($id){
        // Delete Product
        Coupon::where('id',$id)->delete();
        $message = 'Coupon has been deleted successfully';
        session::flash('success_message',$message);
        return redirect()->back();
    }
}
