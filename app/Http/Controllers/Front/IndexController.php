<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class IndexController extends Controller
{
    public function index(){
        // Get Featured Product
        $featuredItemsCount = Product::with('brand')->where('is_featured','Yes')->count();
        $featuredItems = Product::with('brand')->where('status',1)->where('is_featured','Yes')->get()->toArray();
        //$featuredItemsChunk = array_chunk($featuredItems,4);

        // Lastest Product
        $newProducts = Product::with('brand')->where('status',1)->orderBy('id','Desc')->limit(5)->get()->toArray();

        $page_name = "index"; 
        return view('front.index')->with(compact('page_name','featuredItems','newProducts'));
    }
}
