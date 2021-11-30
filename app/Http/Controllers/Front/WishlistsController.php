<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Auth;

class WishlistsController extends Controller
{
    public function updateWishlist(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $countWishlist = Wishlist::countWishlist($data['product_id']);
            if($countWishlist==0){
                // Add in Wishlist
                $wishlist = new Wishlist;
                $wishlist->user_id = Auth::user()->id;
                $wishlist->product_id = $data['product_id'];
                $wishlist->save();
                return response()->json(['status'=>true,'action'=>'add']);
            }else{
                // Remove Product from Wishlist
                Wishlist::where(['user_id'=>Auth::user()->id,'product_id'=>$data['product_id']])->delete();
                return response()->json(['status'=>true,'action'=>'remove']);
            }
        }
    }

    public function wishlist(){
        $userWishlistItems = Wishlist::userWishlistItems();
        // echo "<pre>";  print_r($userWishlistItems); die;

        $meta_title = "Wishlist";
        $meta_description = "hi";
        $meta_keywords = "keywords";
        return view('front.wishlist.wishlist')->with(compact('userWishlistItems','meta_title',
         'meta_description','meta_keywords'));
    }

    public function deleteWishlistItem(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>";  print_r($data); die;
            Wishlist::where('id',$data['wishlistid'])->delete();
            $userWishlistItems = Wishlist::userWishlistItems();
            return response()->json([
                'view'=>(String)View::make('front.wishlist.wishlist_items')->with(compact('userWishlistItems'))
            ]);
        }
    }
}
