<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;

    public static function getShippingCharges($district,$total_weight){
        $shippingDetails = ShippingCharge::where('district',$district)->first()->toArray();
        // dd($shippingDetails); die;
        // $shipping_charges = $shippingDetails['shipping_charges'];
        if($total_weight>0){
            if($total_weight>0 && $total_weight<=500){
                $shipping_charges = $shippingDetails['0_500gm'];
            }else if($total_weight>=501 && $total_weight<=1000){
                $shipping_charges = $shippingDetails['501_1000gm'];
            }else if($total_weight>=1001 && $total_weight<=2000){
                $shipping_charges = $shippingDetails['1001_2000gm'];
            }else if($total_weight>=2001 && $total_weight<=5000){
                $shipping_charges = $shippingDetails['2001_5000gm'];
            }else if($total_weight>=5001){
                $shipping_charges = $shippingDetails['above_5000gm'];
            }else{
                $shipping_charges = 0;
            }
        }else{
            $shipping_charges = 0;
        }
        return $shipping_charges;
    }

    
}
