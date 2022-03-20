<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;

class ProfielController extends Controller
{
    function Index(){
        $id=Auth::id();
        $userName=User::find($id);
        return view('Admin.Edit_Profile',compact('userName'));
    }
    function NameUpdate(Request $req){
        User::find($req->user_id)->update([
            'name'=>$req->name
        ]);

        return back()->with('updateName','Name Change hoise');
    }
    function PasswordUpdate(Request $req){
        $req->validate([

            // 'password'=>'required|confirmed',
            'password'=>['required', 'confirmed', Password::min(8)],


        ]);


        if(Hash::check($req->old_password,Auth::user()->password)){
            User::find(Auth::id())->update([
                'password'=>bcrypt($req->password),
            ]);
            return back()->with('password_update','password update hoise');
        }else{
            return back()->with('password_no_update','old password match hoy nai');
        }

    }

    function ProfileChange(Request $req){
        $req->validate([
            'image'=>['image','mimes:jpg,bmp,png','max:1024'],

        ]);

        $new_profile_photo=$req->image;
        $extension=$new_profile_photo->getClientOriginalExtension();
        $new_name=Auth::id().'.'.$extension;

        if(Auth::user()->photo != 'default.png'){
            $path= public_path()."/uploads/users/".Auth::user()->photo;

            unlink($path);
        }

        Image::make($new_profile_photo)->resize(400,300)->save(base_path('public/uploads/users/'.$new_name));
        User::find(Auth::id())->update([
            'photo'=>$new_name
        ]);
        return back();

    }
}
