<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Sms;
use App\Models\DeliveryAddress;
use Session;
use Auth;

class UsersController extends Controller
{
    public function loginRegister(){
        $page_name = "loginRegister";
        return view('front.users.login_register')->with(compact('page_name'));
    }

    public function registerUser(Request $request){
        if($request->isMethod('post')){
            Session::forget('error_message');
            Session::forget('success_message');
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            // Check if user already exists
            $userCount = User::where('email',$data['email'])->count();
            if($userCount>0){
                $message = "Already Exists";
                session::flash('error_message',$message);
                return redirect()->back();
            }else{
                // Register user in DB
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 0;
                $user->save();


                //Send Register sms
                // $otp = str_random(3); 
                // $mobile = $data['mobile'];
                // Sms::sendSms($mobile,$otp);

                // Send Confirmation Mail For Account Activation
                $email = $data['email'];
                $messageData = [
                    'email' => $data['email'],
                    'name'  => $data['name'],
                    'code'  => base64_encode($data['email'])
                ];
                Mail::send('emails.confirmation',$messageData,function($message) use($email){
                    $message->to($email)->subject('Verification Mail');
                });

                // Redirect Back with Verification mail Sent Message
                $message = "Please confirm your email to continue shopping";
                Session::flash('success_message',$message);
                return redirect()->back();

                // if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                //     // echo "<pre>"; print_r(Auth::user()); die;
                //     //Update User Cart after login
                //     if(!empty(Session::get('session_id'))){
                //         $user_id = Auth::user()->id;
                //         $session_id = Session::get('session_id');
                //         Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                //     }

                //     // //Send Register sms
                //     // $message = "Dear Customer, Myself Sachin Verma";
                //     // $mobile = $data['mobile'];
                //     // Sms::sendSms($message,$mobile);

                //     // Send Register Email
                //     $email = $data['email'];
                //     $messageData = ['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email']];
                //     Mail::send('emails.register',$messageData,function($message) use($email){
                //         $message->to($email)->subject('Welcome to PantryShop');
                //     });
                    
                //     return redirect('cart');
                // }
            }
        }
    }

    public function confirmAccount($email){
        Session::forget('error_message');
        Session::forget('success_message');
        
        // Decode Confirm Email
        $email = base64_decode($email);
        
        // Check User Email Exists
        $userCount = User::where('email',$email)->count();
        if($userCount>0){

            // User Email is already activated or not
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status == 1){
                $message = "Your Account is already activated, Please login to continue shopping";
                Session::flash('error_message',$message);
                return redirect('login-register');
            }else{

                // Update User status to 1 for activate account
                User::where('email',$email)->update(['status'=>1,'email_verified_at'=>now()]);

                // //Send Register SMS
                // // $message = "Dear Customer, Myself Sachin Verma";
                // $mobile = $userDetails['mobile'];
                // Sms::sendSms($mobile);

                // Send Register Email
                $messageData = ['name'=>$userDetails['name'],'mobile'=>$userDetails['mobile'],'email'=>$email];
                Mail::send('emails.register',$messageData,function($message) use($email){
                    $message->to($email)->subject('Welcome to PantryShop');
                });

                // Redirect to Login/Register Page
                $message = "Your account hs been activated ,Please login to continue shopping";
                Session::flash('success_message',$message);
                return redirect('login-register');
            }
        }else{
            abort(404);
        } 
    }

    public function loginUser(Request $request){
        if($request->isMethod('post')){
            Session::forget('error_message');
            Session::forget('success_message');
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){

                // Check account is Activated or NOT
                $userStatus = User::where('email',$data['email'])->first();
                if($userStatus->status == 0){
                    Auth::logout();
                    $message = "Your account is not activated yet ! Please confirm email to activate";
                    Session::flash('error_message',$message);
                    return redirect()->back();
                }
               
                //Update User Cart after login
                if(!empty(Session::get('session_id'))){
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                }

                return redirect('/');
            }else{
                $message = "Invalid Username or Password";
                Session::flash('error_message',$message);
                return redirect()->back();
            }
        }
    }

    public function checkEmail(Request $request){
        $data = $request->all();
        $emailCount = User::where('email',$data['email'])->count();
        if($emailCount>0){
            return "false"; 
        }else{
            return "true";
        }
    }

    public function logoutUser(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function forgotPassword(Request $request){
        $page_name = "forgotPassword";
        if($request->isMethod('post')){
            $data = $request->all();

            // check email exists or not
            $emailCount = User::where('email',$data['email'])->count();
            if($emailCount==0){
                $message = "Provided email doesn't associate with any account";
                Session::flash('error_message',$message);
                Session::forget('success_message');
                return redirect()->back();
            }

            // Generate New Password
            $random_password = str_random(8);

            // Encode Secure Password
            $new_password = bcrypt($random_password);

            // Update Password
            User::where('email',$data['email'])->update(['password'=>$new_password]);

            // Send mail
            $userName = User::select('name')->where('email',$data['email'])->first();

            $email = $data['email'];
            $name = $userName->name;
            $messageData = [
                'email' => $email,
                'name' => $name,
                'password' => $random_password
            ];
            Mail::send('emails.forgot_password',$messageData,function($message)use($email){
                $message->to($email)->subject('New Password - Pantryshop');
            });

            // Return to login page
            $message = "Please check your mail box for new password";
            Session::flash('success_message',$message);
            Session::forget('error_message');
            return redirect('login-register');
        }
        return view('front.users.forgot_password')->with(compact('page_name'));
    }

    public function account(){
        $page_name = "account";
        return view('front.users.account')->with(compact('page_name'));
    }

    public function edit_profile(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach ($data['id'] as $key => $user){
                if(!empty($attr)){
                    ProductsAttribute::where(['id'=>$data['attrId'][$key]])->update(
                        ['price'=>$data['price'][$key],
                        'discount'=>$data['discount'][$key],
                        'stock'=>$data['stock'][$key]]
                    );   
                }
            }
            $success_message = 'Attributes Updated Successfully';
            session::flash('success_message',$success_message);
            return redirect()->back();
        }
        return view('front.users.edit_profile');
    }

    public function ChangeUserPwd(){
        $page_name = "change_user_pwd";
        return view('front.users.change_password')->with(compact('page_name'));
    }

    public function chkUserPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            
            $user_id = Auth::User()->id;
            $chkPassword = User::select('password')->where('id',$user_id)->first();
            if(Hash::check($data['current_pwd'],$chkPassword->password)){
                return "true";
            }else{
                return "false";
            }
        }
    }

    public function updateUserPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            
            $user_id = Auth::User()->id;
            $chkPassword = User::select('password')->where('id',$user_id)->first();
            if(Hash::check($data['current_pwd'],$chkPassword->password)){
                // Update Current Password
                $new_password = bcrypt($data['new_pwd']);
                User::where('id',$user_id)->update(['password'=>$new_password]);
                $message = "Password Updated Successfully";
                Session::flash('success_message',$message);
                Session::forget('error_message');
                return redirect('/account/edit-profile');
            }else{
                $message = "Current Password is Incorrect";
                Session::flash('error_message',$message);
                Session::forget('success_message');
                return redirect()->back();
            }
        }
    }
    
    // Address Book 
    public function addressBook(){
        $deliveryAddresses = DeliveryAddress::deliveryAddresses();
        return view('front.users.addressBook')->with(compact('deliveryAddresses'));
    }
}
