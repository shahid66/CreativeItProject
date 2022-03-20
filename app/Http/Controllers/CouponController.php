<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function Coupon(){
        $AllCoupon=Coupon::simplePaginate(5);
        return view('Admin.Coupon.Coupon',compact('AllCoupon'));
    }
    function CouponInsert(Request $req){
        Coupon::insert([
            'coupon_name'=>$req->coupon_name,
            'coupon_discount'=>$req->coupon_discount,
            'coupon_validity'=>$req->coupon_validity,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }
}
