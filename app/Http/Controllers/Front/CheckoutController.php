<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\DeliveryAddress;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Sms;
use App\Models\ShippingCharge;
use App\Models\ProductsAttribute;
use Auth;
use Session;
use DB;

class CheckoutController extends Controller
{
    public function checkout(Request $request){
        
        $userCartItems = Cart::userCartItems();
        // echo "<pre>"; print_r($userCartItems); die;

        if(count($userCartItems)==0){
            $message = "Shopping cart is empty! Please add products to checkout";
            Session::put('error_message',$message);
            return redirect('cart');
        }

        // Website Security
            
            // Fetch User Cart Items
            foreach($userCartItems as $key => $cart){

                // Prevent DISABLE product to order
                $product_status = Product::getProductStatus($cart['product_id']);
                if($product_status==0){
                    // Product::deleteCartProduct($cart['product_id']);
                    $message = $cart['product']['product_name']." is not available right now so please remove product from cart";
                    session::flash('error_message',$message);
                    return redirect('/cart');
                }

                // Prevent OUT OF STOCK Product to order
                $product_stock = Product::getProductStock($cart['product_id'],$cart['size']);
                if($product_stock==0){
                    $message = $cart['product']['product_name']." is now out of stock so please remove product from cart";
                    session::flash('error_message',$message);
                    return redirect('/cart');
                }

                // Prevent DISABLED or DELETED Attributes to order
                $get_attribute_count = Product::getAttributeCount($cart['product_id'],$cart['size']);
                if($get_attribute_count==0){
                    $message = $cart['product']['product_name']." is not available so please remove product from cart";
                    session::flash('error_message',$message);
                    return redirect('/cart');
                }

                // Preven DISABLED Category to order
                $category_status = Product::getCategoryStatus($cart['product']['category_id']);
                if($category_status==0){
                    $message = $cart['product']['product_name']." is not available so please remove product from cart";
                    session::flash('error_message',$message);
                    return redirect('/cart');
                }
            }
            
        // Website Security


        // Total Price and Total Weight
        $total_price = 0;
        $total_weight = 0;
        foreach ($userCartItems as $item){
            $product_weight = $item['weight'];
            $total_weight = $total_weight + ($product_weight * $item['quantity']);
            $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']);
            $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']);
        }

        // Get Delivery Addresses
        $deliveryAddresses = DeliveryAddress::deliveryAddresses();
       
        foreach ($deliveryAddresses as $key => $value) {
            $shippingCharges = ShippingCharge::getShippingCharges($value['district'],$total_weight);
            // echo $shippingCharges; die;
            $deliveryAddresses[$key]['shipping_charges'] = $shippingCharges;
            // echo $shippingCharges; die;
            
            // COD 
            $deliveryAddresses[$key]['cod'] = DB::table('shipping_charges')->where('district',$value['district'])->pluck('COD')->first();

        }

        // echo "<pre>"; print_r($deliveryAddresses); die;

        if($request->isMethod('post')){
            $data = $request->all();

            if(empty($data['address_id'])){
                $message = "Please select Delivery Address";
                session::flash('error_message',$message);
                return redirect()->back();
            }
            if(empty($data['payment_gateway'])){
                $message = "Please select Payment Method";
                session::flash('error_message',$message);
                return redirect()->back();
            }
 
            if($data['payment_gateway']=="COD"){
                $payment_method = "COD";
                $order_status = "New";
            }else{
                echo "Comming Soon"; die;
                $payment_method = "Prepaid";
                $order_status = "Pending";
            }

            // Get Order Delivery Address from address_id
            $deliveryAddress = DeliveryAddress::where('id',$data['address_id'])->first()->toArray();

            // Get Shipping Charges
            $shipping_charges = ShippingCharge::getShippingCharges($deliveryAddress['district'],$total_weight);
            
            // Calculate Grand Total
            $grand_total = $total_price + $shippingCharges - Session::get('couponAmount');

            // Insert Grand Total in Session
            Session::put('grand_total',$grand_total);

            DB::beginTransaction();

            // Insert Order Addres
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->name = $deliveryAddress['name'];
            $order->mobile = $deliveryAddress['mobile'];
            $order->email = Auth::user()->email;
            $order->pincode = $deliveryAddress['pincode'];
            $order->state = $deliveryAddress['state'];
            $order->address = $deliveryAddress['address'];
            $order->area = $deliveryAddress['area'];
            $order->landmark = $deliveryAddress['landmark'];    
            $order->address_type = $deliveryAddress['address_type'];
            $order->shipping_charges = $shipping_charges;
            $order->coupon_code = Session::get('couponCode');
            $order->coupon_amount = Session::get('couponAmount');
            $order->order_status = "New";
            $order->payment_method = $payment_method;
            $order->payment_gateway = $data['payment_gateway'];
            $order->grand_total = Session::get('grand_total');
            $order->save();

            // Get Last Inserted Order ID
            $order_id = DB::getPdo()->lastInsertId();

            // Add User Cart Items
            $cartItem = Cart::where('user_id',Auth::user()->id)->get()->toArray();
            foreach($cartItem as $key => $item){
                $cartItem = new OrdersProduct;
                $cartItem->order_id = $order_id;
                $cartItem->user_id = Auth::user()->id;

                $getProductDetails = Product::with('brand')->select('product_code','product_name','brand_id')->
                where('id',$item['product_id'])->first()->toArray();
                $cartItem->product_id = $item['product_id'];
                $cartItem->product_name = $getProductDetails['product_name'];
                $cartItem->product_code = $getProductDetails['product_code'];
                $cartItem->product_brand = $getProductDetails['brand']['name'];
                $cartItem->product_size = $item['size'];
                $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']);
                $cartItem->product_price = $getDiscountedAttrPrice['final_price'];
                $cartItem->product_qty = $item['quantity'];
                $cartItem->save();

                // Product Stock Management of COD method
                if($data['payment_gateway']=="COD"){
                    //Reduce Stock Function
                    $getProductStock = ProductsAttribute::where(['product_id'=>$item['product_id'],'size'=>$item['size']])->first()->toArray();
                    $newStoke = $getProductStock['stock'] - $item['quantity'];
                    ProductsAttribute::where(['product_id'=>$item['product_id'],'size'=>$item['size']])->update(['stock'=>$newStoke]);
                }

            }

            // Insert Order id in session
            Session::put('order_id',$order_id);

            DB::commit(); 
            
            if($data['payment_gateway']=="COD"){

                // Send Order SMS
                $message = "Dear Customer, your order".$order_id." has been successfully placed 
                We will intimate you once your order is shipped";
                $mobile = $deliveryAddress['mobile'];
                Sms::sendSms($message,$mobile);

                // Send Order Mail
                $orderDetails = Order::with('orders_products')->where('id',$order_id)->first()->toArray();
                // $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();

                $email = Auth::user()->email;
                $messageData = [
                    'email' => $email,
                    // 'name' => Auth::user()->name,
                    'name' => $deliveryAddress['name'],
                    'order_id' => $order_id,
                    'orderDetails' => $orderDetails,
                    // 'userDetails' => $userDetails,
                ];

                Mail::send('emails.order',$messageData,function($message) use($email){
                    $message->to($email)->subject('Order Placed - PantryShop');

                });

                return redirect('/thanks');

            }else{
                echo "Prepaid"; die;
            }

        }

        return view('front.checkout.checkout')->with(compact('userCartItems','deliveryAddresses','total_price'));
    }

    public function thanks(){
        if(Session::has('order_id')){
            // Empty User Cart
            Cart::where('user_id',Auth::user()->id)->delete();
            return view('front.checkout.order_placed'); 
        }else{
            return redirect('/cart');
        }
    }
    
}
