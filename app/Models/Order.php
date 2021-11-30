<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orders_products(){
        return $this->hasMany('App\Models\OrdersProduct','order_id');
    }

    public static function getOrderStatus($order_id){
        $getOrderStaus = Order::select('order_status')->where('id',$order_id)->first();
        return $getOrderStaus->order_status;
    }
}
