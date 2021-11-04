<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Banner;

class Banner extends Model
{
    use HasFactory;

    public static function getBanners(){
        // Get Banners
        $getBanners = Banner::where('status',1)->get()->toArray();
        //dd($getBanners); die;
        return $getBanners;
    }
}
