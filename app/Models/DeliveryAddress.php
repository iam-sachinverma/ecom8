<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PincodeArea;
use Auth;

class DeliveryAddress extends Model
{
    use HasFactory;
    
    public static function deliveryAddresses(){
        $user_id = Auth::user()->id;
        $deliveryAddresses = DeliveryAddress::where('user_id',$user_id)->get()->toArray();
        return $deliveryAddresses;
    }

    public static function getPincodeArea($pincode){
        $getArea = PincodeArea::select('district','state')->where('pincode',$pincode)->get()->first()->toArray();
        // return $getArea;
        return array(
            'state'=>$getArea['state'],
            'district'=>$getArea['district']
        );
    }
}
