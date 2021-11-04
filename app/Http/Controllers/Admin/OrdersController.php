<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderStatus;
use App\Models\Sms;
use App\Models\OrdersLog;
use Session;
use Auth;

class OrdersController extends Controller
{
    public function orders(){
        Session::put('page','orders');
        $orders = Order::with('orders_products')->orderBy('id','Desc')->get()->toArray();
        // dd($orders); die;
        return view('admin.orders.orders')->with(compact('orders'));
    }

    public function orderDetails($id){
        $orderDetails = Order::with('orders_products')->where('id',$id)->first()->toArray();
        $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();
        $orderStatuses = OrderStatus::where('status',1)->get()->toArray();
        $orderLog = OrdersLog::where('order_id',$id)->orderBy('id','Desc')->get()->toArray();
        return view('admin.orders.order_details')->with(compact(
            'orderDetails','userDetails','orderStatuses','orderLog'));
    }

    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            
            //Update Order Status
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            Session::flash('success_message','Order Status Updated');

            // Update Courier Name and Tracking Number
            if(!empty($data['courier_name']) && !empty($data['tracking_number'])){
                Order::where('id',$data['order_id'])->update(['courier_name'=>$data['courier_name'],
                'tracking_number'=>$data['tracking_number']]);
            }
            
            // Get User Mobile
            $deliveryDetails = Order::select('mobile','name','email')->where('id',$data['order_id'])->first()->toArray();

            // Send Order Status Update SMS
            $message = "Dear Customer, your order #".$data['order_id']." status has been updated to ".$data['order_status']." placed with";
            $mobile = $deliveryDetails['mobile'];
             Sms::sendSms($message,$mobile);

            // Send Order Status Mail
            $orderDetails = Order::with('orders_products')->where('id',$data['order_id'])->first()->toArray();

            $email = $deliveryDetails['email'];
            $messageData = [
                'email' => $email,
                'name' => $deliveryDetails['name'],
                'order_id' => $data['order_id'],
                'order_status' => $data['order_status'],
                'courier_name' => $data['courier_name'],
                'tracking_number' => $data['tracking_number'],
                'orderDetails' => $orderDetails,
            ];

            Mail::send('emails.order_status',$messageData,function($message) use($email){
                $message->to($email)->subject('Your Order Status - PantryShop');
            });

            //Update Order Logs
            $log = new OrdersLog;
            $log->order_id = $data['order_id'];
            $log->order_status = $data['order_status'];
            $log->save();

            return redirect()->back();
        }
    }


    public function viewOrderInvoice($id){
        $orderDetails = Order::with('orders_products')->where('id',$id)->first()->toArray();
        $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();

        return view('admin.orders.order_invoice')->with(compact('orderDetails','userDetails'));
    }
}
