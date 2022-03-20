<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerRegisterController extends Controller
{
   function customer_register(Request $req){

    CustomerLogin::insert([
        'name'=>$req->name,
        'email'=>$req->email,
        'password'=>bcrypt($req->password),
        'created_at'=>Carbon::now(),
    ]);
    return back()->with('customerInsert','User Added');
   }

   function customer_register_view(){

    return view('Frontend.CustomerRegister');
   }
}
