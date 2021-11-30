<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrdersLog;
use Auth;
use Session;

class OrdersController extends Controller
{
    public function orders(){
        $orders = Order::with('orders_products')->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
        return view('front.orders.orders')->with(compact('orders'));
    }

    public function orderDetails($id){
        $orderDetails = Order::with('orders_products')->where('id',$id)->first()->toArray();
        return view('front.orders.order_details')->with(compact('orderDetails'));
    }

    public function orderCancel($id, Request $request){
        if($request->isMethod('post')){

            $data = $request->all();

            if(isset($data['reason']) && empty($data['reason'])){
                return redirect()->back();
            }
            // Get User Details
            $user_id_auth = Auth::user()->id;

            // Get User who order
            $user_id_order = Order::select('user_id')->where('id',$id)->first();

            if($user_id_auth==$user_id_order->user_id){

                // Update Order Status to Cancelled
                Order::where('id',$id)->update(['order_status'=>'Cancelled']);

                // Update Order Log
                $log = new OrdersLog;
                $log->order_id = $id;
                $log->order_status = "User Cancelled";
                $log->reason = $data['reason'];
                $log->updated_by = "User";
                $log->save();

                $message = "Order has been cancelled";
                Session::flash('success_message',$message);
                return redirect()->back();

            }else{

                $message = "Your order cancellation request is not valid";
                Session::flash('error_message',$message);
                return redirect('orders');
            }
        }
    }
}
