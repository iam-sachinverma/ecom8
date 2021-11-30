<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Wishlist extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }

    public static function countWishlist($product_id){
        $countWishlist = Wishlist::where(['user_id'=>Auth::user()->id,'product_id'=>$product_id])->count();
        return $countWishlist;
    }

    public static function userWishlistItems(){
        $userWishlistItems = Wishlist::with(['product'=>function($query){
            $query->select('id','product_name','product_code','product_price','main_image','product_discount');
        }])->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
        return $userWishlistItems;
    }
}
