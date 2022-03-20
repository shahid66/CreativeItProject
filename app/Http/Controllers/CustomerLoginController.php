<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    function customer_login(Request $req){
        if(Auth::guard('customerlogin')->attempt(['email'=>$req->email,'password'=>$req->password])){
            return redirect('/');

        }else{
            return redirect('/customer/register/view');
        }
    }

    function customer_logOut(Request $req){
        Auth::guard('customerlogin')->logout();
        return redirect('/customer/register/view');
    }
}
