<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Sms extends Model
{
    use HasFactory;
    public static function sendSms($otp,$mobile){
        /*Code for SMS Script Starts*/
        $url="http://world.msg91.com/api/otp.php";
        $postData = array(
            'authkey' => "366108Ajyl0z3LkB611fbc82P1",
            'mobile' => $mobile,
            'message' => urlencode("Test message"),
            'sender' => "YourSender",
            'otp' => $otp,
        );
        $paramArr['url'] = $url;
        $paramArr['postData'] = $postData;
        Request($paramArr);
        /*Code for SMS Script Ends*/
    }
}
