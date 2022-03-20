<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    function wishInsert($product_id){
        $user_id=Auth::guard('customerlogin')->id();
        WishList::insert([
            'user_id'=>$user_id,
            'product_id'=>$product_id
        ]);
        return back()->with('wishAdd','Wish add to cart');
    }
}
