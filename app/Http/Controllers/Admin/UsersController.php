<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;

class UsersController extends Controller
{
    public function users(){
        Session::put('page','users');
        $users = User::get()->toArray();
        // dd($users); die;
        return view('admin.users.users')->with(compact('users'));
    }
}
