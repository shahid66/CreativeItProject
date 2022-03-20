<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function Index(){
        $AllUser=User::where('id','!=',Auth::id())->SimplePaginate(2);
        return view('Admin.Dashboard',compact('AllUser'));
    }
    function add_user(Request $req){
        $req->validate([
            'name'=>['required'],
            'email'=>['required','unique:users'],
            'password'=>['required'],
            'role'=>['required']
        ]);
        User::insert([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>bcrypt($req->password),
            'role'=>$req->role,
            'created_at'=>Carbon::now(),

        ]);
        return back()->with('user_add','user add hoise');
    }

    function userDelete($user_id){

        User::find($user_id)->delete();
        return back()->with('UserDelete','User delete successful !');
    }
}
