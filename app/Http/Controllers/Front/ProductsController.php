<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\Cart;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\DeliveryAddress;
use Session;
use Auth;
use DB;

class ProductsController extends Controller
{
    public function listing(Request $request){
        Paginator::useBootstrap();
        $page_name = "listing"; 
        if($request->ajax()){
            $data = $request->all();
            echo "<pre>"; print_r($data); die;
            $url = $data['url'];
            $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
            if($categoryCount>0){
                //echo "Category Exist"; die;
                $categoryDetails = Category::catDetails($url);
                //echo "<pre>"; print_r($categoryDetails); die;

                $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->
                    where('status',1);    

                
                // if Cuisine Filter selected
                if(isset($data['cuisine']) && !empty($data['cuisine'])){
                    $categoryProducts->whereIn('products.cuisine',$data['cuisine']);
                }

                // if country Filter selected
                if(isset($data['country']) && !empty($data['country'])){
                    $categoryProducts->whereIn('products.country',$data['country']);
                }

                // if foodpreference Filter selected
                if(isset($data['foodpreference']) && !empty($data['foodpreference'])){
                    $categoryProducts->whereIn('products.foodpreference',$data['foodpreference']);
                }

    
                //  Sort Filter
                if(isset($data['sort']) && !empty($data['sort'])){
                    if($data['sort']=="product_latest"){
                        $categoryProducts->orderBy('id','Desc');
                    }else if($data['sort']=="price_lowest"){
                        $categoryProducts->orderBy('product_price','Asc');
                    }else if($data['sort']=="price_highest"){
                        $categoryProducts->orderBy('product_price','Desc');
                    }else if($data['sort']=="product_name_a_z"){
                        $categoryProducts->orderBy('product_name','Asc');
                    }else if($data['sort']=="product_name_z_a"){
                        $categoryProducts->orderBy('product_name','Desc');
                    }    
                }else{
                    $categoryProducts->orderBy('id','Asc');
                } 
                
                $categoryProducts = $categoryProducts->paginate(15);
                
                //echo "<pre>"; print_r($categoryProducts); die;
                return view('front.products.ajax_products_listing')->with(compact('categoryDetails','categoryProducts','url'));    
            }else{
                abort(404);
            }
                 
        }else{
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
            if($categoryCount>0){
                //echo "Category Exist"; die;
                $categoryDetails = Category::catDetails($url);
                //echo "<pre>"; print_r($categoryDetails); die;
                $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->
                    where('status',1);
                // echo "<pre>"; print_r($categoryProducts); die;    
    
                $categoryProducts = $categoryProducts->paginate(15);

                // Product Array
                $productFilters = Product::productFilters();
                $cuisineArray = $productFilters['cuisineArray'];
                $countryArray = $productFilters['countryArray'];
                $foodpreferenceArray = $productFilters['foodpreferenceArray'];

                $page_name = "listing";
                //echo "<pre>"; print_r($categoryProducts); die;
                return view('front.products.listing')->with(compact('page_name','categoryDetails','categoryProducts','url','page_name','cuisineArray','countryArray','foodpreferenceArray'));    
            }else{
                abort(404);
            }   
        }
        
    }

    // Product DETAIL Page Note: Use parameters like Product Name or Code or any product detail in URL for SEO 

    public function detail($id){
        $page_name = "detail";
        $productDetails = Product::with(['brand','category','attributes'=>function($query){
            $query->where('status',1);
        },
        'images'=>function($query){
            $query->where('status',1);
        }])->find($id)->toArray();
        // dd($productDetails); die;
        
        $relatedProducts = Product::with('brand')->where('category_id',$productDetails['category']['id'])->where('id','!=',$id)->where('status',1)->limit(3)->inRandomOrder()->get()->toArray();
        return view('front.products.detail')->with(compact('page_name','productDetails','relatedProducts'));
    }

    public function getProductPrice(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($data['product_id'],$data['size']);   
            return $getDiscountedAttrPrice;
        }
    }

    // Add To Cart
    public function addtocart(Request $request){
       if($request->isMethod('post')){
           $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if($data['quantity']<=0 || $data['quantity']="" ){
                $data['quantity']=1;
            }

            if(empty($data['size'])){
                $message = "Please select product size";
                session::flash('error_message',$message);
                return redirect()->back();
            }

           // Check Product Stock is available or not
           $getProductStock = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first()->toArray();
           if($getProductStock['stock']<$data['quantity']){
               $message = "Out of Stock";
               session::flash('error_message',$message);
               return redirect()->back();
            }

            // Generate Session ID if not exists
            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }

            // Check Product if already in cart 
            if(Auth::check()){
                // User is logged in
                $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'user_id'=>Auth::user()->id])->count();
            }else {
                // User is not logged in
                $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'session_id'=>Session::get('session_id')])->count();
            }
            if($countProducts>0){
                $message = "Product Size already exists in cart";
                session::flash('error_message',$message);
                return redirect()->back();
            }

            if(Auth::check()){
                $user_id = Auth::user()->id;
            }else{
                $user_id = 0;
            }

            //Get Weight of Product
            $attr_weight = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->select('weight')->get()->first()->toArray(); 

            // Add Prroduct to Cart table
            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->user_id = $user_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->weight = $attr_weight['weight'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = "Product added in cart";
            session::flash('success_message',$message);
            return redirect()->back();

        }
    }

    // Shopping Cart
    public function cart(){
        $userCartItems = Cart::userCartItems();
        if(count($userCartItems)==0){
            return view('front.products.empty_cart');
        }else{
            return view('front.products.cart')->with(compact('userCartItems'));
        }
    }

    // Update Cart Item Quantity
    public function updateCartItemQty(Request $request){
        if($request->ajax()){
            $data = $request->all();

            // Get cartID
            $cartDetails = Cart::find($data['cartid']);

            // Check Available Stock
            $availableStock = ProductsAttribute::select('stock')->where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size']])->first()->toArray();

            //Check Stock is available or not
            if($data['qty']>$availableStock['stock']){
                $userCartItems = Cart::userCartItems();
                return response()->json([
                    'status'=>false,              
                    'message'=>'Only'.($data['qty']-1).' ! Stock is available ',
                    'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
                ]);
            }

            // Check Size Available
            $availableSize = ProductsAttribute::where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size'],'status'=>1])->count();
            if($availableSize==0){
                $userCartItems = Cart::userCartItems();
                return response()->json([
                    'status'=>false,
                    'message'=>'This product size is now Out of Stock',
                    'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
                ]);
            } 

            // $cartDetails = Cart::find($data['cart_id']);
            Cart::where('id',$data['cartid'])->update(['quantity'=>$data['qty']]);
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'status'=>true,
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)view::make('front.products.cart_items')->with(compact('userCartItems'))
            ]);
        }
    }

    // Delete Cart Item
    public function deleteCartItem(Request $request){
        if($request->ajax()){
            $data = $request->all();
            Cart::where('id',$data['cartid'])->delete();
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
                return response()->json([
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
            ]);
        }
    }
    
    // Apply Coupon
    public function applyCoupon(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data);
            $userCartItems = Cart::userCartItems();
            $couponCount = Coupon::where('coupon_code',$data['code'])->count();
            if($couponCount==0){
                $userCartItems = Cart::userCartItems();
                $totalCartItems = totalCartItems();
                Session::forget('couponCode');
                Session::forget('couponAmount');
                return response()->json([
                    'status'=>false,
                    'message'=>'Enter a valid coupon',
                    'totalCartItems'=>$totalCartItems,
                    'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
                ]);
            }else{
                // Check Other Condition

                // Get Coupon Details
                $couponDetails = Coupon::where('coupon_code',$data['code'])->first();

                // Check if Coupon is Inactive
                if($couponDetails->status==0){
                    $message = "This Coupon is not active";
                }

                // Check If COUPON is Single or Multiple Times use
                if($couponDetails->coupon_type == "Single Times"){
                    // Check in Order Table if coupon already availed by the USER
                    $couponCount = Order::where(['coupon_code'=>$data['code'],'user_id'=>Auth::user()->id])->count();
                    if($couponCount >= 1){
                        $message = "This coupon code is already used by you!";
                    }
                    
                }

                // Check if coupon Expired 
                $expiry_date = $couponDetails->expiry_date;
                $currentDate = date('Y-m-d');
                if($expiry_date<$currentDate){
                    $message = "This Coupon is expired";
                }

                // Check if coupon is for selected users
                // Get all selected users
                if(!empty($couponDetails->users)){
                    $usersArr = explode(",",$couponDetails->users);

                    // Get Users ID of all selected users
                    foreach($usersArr as $key => $user){
                        $getUserID = User::select('id')->where('email',$user)->first()->toArray();
                        $userID[] = $getUserID['id'];
                    }    
                }
                
            
                $total_amount = 0;

                foreach($userCartItems as $key => $item){

                    if(!empty($couponDetails->users)){
                        if(!in_array($item['user_id'], $userID)){
                            $message = "This Coupon not belong to you";
                        }
                    }
                
                    $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']);
                    $total_amount  = $total_amount + ($attrPrice['final_price'] * $item['quantity']);
                 
                }

                if(isset($message)){
                    $userCartItems = Cart::userCartItems();
                    $totalCartItems = totalCartItems();
                    return response()->json([
                        'status'=>false,
                        'message'=>$message,
                        'totalCartItems'=>$totalCartItems,
                        'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
                    ]);
                }else{
                    
                    // Check Amount Type Fixed 0r Percentage
                    if($couponDetails->amount_type=="Fixed"){
                        $couponAmount = $couponDetails->amount;
                    }else{
                        $couponAmount = $total_amount * ($couponDetails->amount/100);
                    }     
                    $grand_total = $total_amount - $couponAmount;
                    

                    // Add Coupon Code & Amount in Session
                    Session::put('couponAmount',$couponAmount);
                    Session::put('couponCode',$data['code']);

                    $message = "Coupon Applied";
                    $totalCartItems = totalCartItems();
                    $userCartItems = Cart::userCartItems();
                    return response()->json([
                        'status'=>true,
                        'message'=>$message,
                        'totalCartItems'=>$totalCartItems,
                        'couponAmount'=>$couponAmount,
                        'grand_total'=>$grand_total,
                        'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
                    ]);

                }

            }
        }
    }

    // Check Pincode Detail Page
    public function checkPincode(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            
            if(is_numeric($data['pincode']) && $data['pincode'] > 0 && $data['pincode'] == round($data['pincode'], 0)){
                $pincodeCount = DB::table('pincode_areas')->where('pincode',$data['pincode'])->count();
                if($pincodeCount==0){
                    echo "This pincode is not available for delivery";
                }else{
                    echo "This pincode is available for delivery";
                }
            }else{
                echo "Please enter valid pincode";
            }
        }
    }

}
