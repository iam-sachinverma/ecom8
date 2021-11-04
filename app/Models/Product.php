<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id')->select('id','name');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand','brand_id')->select('id','name');
    }

    public function attributes(){
        return $this->hasMany('App\Models\ProductsAttribute');
    }

    public function images(){
        return $this->hasMany('App\Models\ProductsImage');
    }

    public static function productFilters(){
        //Product Filters
        $productFilters['cuisineArray'] = array('Italian','Indian','Thai','English','Mediterranean');
        $productFilters['foodpreferenceArray'] = array('Vegetarian','Non Vegetarian','Contain Egg','Vegan');
        $productFilters['countryArray'] = array('America','England','Australia','Belgium','Canada');
        return $productFilters;
    }


    // Product Attributes Discount Price
    public static function getDiscountedAttrPrice($product_id,$size){
        $proAttrPrice = ProductsAttribute::where(['product_id'=>$product_id,'size'=>$size])->
        first()->toArray();
        $proDetails = Product::select('product_discount','category_id')->
        where('id',$product_id)->first()->toArray();
        //echo "<pre>"; print_r($proDetails); die;
        
        if($proDetails['product_discount']>0){
            // If Product Discount Exists
            $final_price = $proAttrPrice['price'] - ($proAttrPrice['price']*
            $proAttrPrice['discount']/100);
            // Discount Money
            $save = $proAttrPrice['price'] - $final_price;
        }else{
            $final_price = $proAttrPrice['price'];
            $save = 0;
        }
        return array(
            'product_price'=>$proAttrPrice['price'],'attribute_discount'=>$proAttrPrice['discount'],'product_discount'=>$proDetails['product_discount'],'final_price'=>$final_price,'save'=>$save,
        );
        
    }


    // Get Product Image
    public static function getProductImage($product_id){
        $getProductImage = Product::select('main_image')->where('id',$product_id)->first()->toArray();
        return $getProductImage['main_image'];
    }

    // Get Product Status
    public static function getProductStatus($product_id){
        $getProductstatus = Product::select('status')->where('id',$product_id)->first()->toArray();
        return $getProductstatus['status'];
    }

    // Delete product from usercart
    public static function deleteCartProduct($product_id){
        Cart::where('product_id',$product_id)->delete();
    }

    // Get Product Stock
    public static function getProductStock($product_id,$product_size){
        $getProductStock = ProductsAttribute::select('stock')->where(['product_id'=>$product_id,'size'=>$product_size])->first()->toArray();
        return $getProductStock['stock'];
    }

    // Get Attribute Count
    public static function getAttributeCount($product_id,$product_size){
        $getAttributeCount = ProductsAttribute::where(['product_id'=>$product_id,'size'=>$product_size,'status'=>1])->count();
        return $getAttributeCount;
    }

    // Get Category Status
    public static function getCategoryStatus($category_id){
        $getCategoryStatus = Category::select('status')->where('id',$category_id)->first()->toArray();
        return $getCategoryStatus['status'];
    }


    // // Product Discount Price
    // public static function getDiscountedPrice($product_id){
    //     $proDetails = Product::select('product_price','product_discount','category_id')->
    //     where('id',$product_id)->first()->toArray();
    //     //echo "<pre>"; print_r($proDetails); die;
    //     $catDetails = Category::select('category_discount')->
    //     where('id',$proDetails['category_id'])->first()->toArray();
        
    //     // Sale Price = Cost Price - Discount Price
    //     if($proDetails['product_discount']>0){
    //         // If Product Discount Exists
    //         $discounted_price = $proDetails['product_price'] - ($proDetails['product_price']*
    //         $proDetails['product_discount']/100);
    //     }else{
    //         $discounted_price = 0;
    //     }
    //     return $discounted_price;

    // }

}
