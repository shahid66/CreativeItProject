<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    function wishInsert($product_id){

        if(WishList::where('product_id',$product_id)->first()){

            $user_id=Auth::guard('customerlogin')->id();
            WishList::where('user_id',$user_id)->where('product_id',$product_id)->delete();
            
            return back()->with('wishAdd','Wish Delete to cart');
        }else{

            $user_id=Auth::guard('customerlogin')->id();
            WishList::insert([
                'user_id'=>$user_id,
                'product_id'=>$product_id
            ]);
            return back()->with('wishAdd','Wish add to cart');
        }

    }
}
