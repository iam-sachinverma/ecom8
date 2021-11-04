<?php
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;


function totalCartItems(){
    if(Auth::check()){
        $user_id = Auth::user()->id;
        $totalCartItems = Cart::where('user_id',$user_id)->sum('quantity');
    }else{
        $session_id = Session::get('session_id');
        $totalCartItems = Cart::where('session_id',$session_id)->sum('quantity');
    }
    return $totalCartItems;
}

function getDiscountedPrice($product_id){
    $proDetails = Product::select('product_price','product_discount','category_id')->
    where('id',$product_id)->first()->toArray();
    //echo "<pre>"; print_r($proDetails); die;
    $catDetails = Category::select('category_discount')->
    where('id',$proDetails['category_id'])->first()->toArray();
    
    // Sale Price = Cost Price - Discount Price
    if($proDetails['product_discount']>0){
        // If Product Discount Exists
        $getDiscountedPrice = $proDetails['product_price'] - ($proDetails['product_price']*
        $proDetails['product_discount']/100);
    }else{
        $getDiscountedPrice = 0;
    }
    return $getDiscountedPrice;
}


