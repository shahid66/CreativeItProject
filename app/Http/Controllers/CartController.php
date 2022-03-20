<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\color;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartInsert(Request $req)
    {
        // $req->validate([
        //     'color_id'=>['required'],
        //     'size_id'=>['required'],

        // ]);

        print_r($req->all());
        die();

        $color_id=$req->color_id;
        $size_id=$req->size_id;
        $product_id=$req->product_id;
        $quantity=$req->qtybutton;
        $user_id=Auth::guard('customerlogin')->user()->id;

        $quantity_ase_kin= Inventory::where('product_id',$product_id)->where('color_id',$color_id)->where('size_id',$size_id)->first()->quantity;
        if($quantity_ase_kin> 1){
            if (Cart::where('user_id', $user_id)->where('product_id', $product_id)->where('color_id', $color_id)->where('size_id', $size_id)->exists()) {
                Cart::where('product_id', $product_id)->increment('quantity', $quantity);
            } else {
                Cart::insert([
                    'user_id'=>$user_id,
                    'product_id'=>$product_id,
                    'color_id'=>$color_id,
                    'size_id'=>$size_id,
                    'quantity'=>$quantity,
                    'created_at'=>Carbon::now()

                ]);
            }
            return back()->with('cartAdd','Add to cart successful');
        }
        return back()->with('cartAdd','Stock e nai');
    }

    function cartDelete($cart_id){

        Cart::find($cart_id)->delete();
        return back()->with('cartDelete','Delete from cart successful');

    }

   function allCartItem(Request $req){
    $coupon_code=$req->coupon_name;
    $message=null;
    if($coupon_code == ""){
        $coupon_discount=0;

    }else{
        if(Coupon::where('coupon_name',$coupon_code)->exists()){
            if(Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name',$coupon_code)->first()->coupon_validity){
                $message="Coupon Code Expired";
                $coupon_discount=0;
            }else{
                $coupon_discount_final = Coupon::where('coupon_name',$coupon_code)->first()->coupon_discount;

                $cartItem=Cart::where('user_id',Auth::guard('customerlogin')->id())->get();
                $c_product_price=0;
                foreach($cartItem as $item){
                     $c_product_price+=$item->rel_to_product->discount_price* $item->quantity;
                }
                $coupon_discount=(($c_product_price*$coupon_discount_final)/100);

                return view('Frontend.Cart.ViewCart',compact('cartItem','coupon_discount','message','c_product_price'));
            }
        }else{
            $message="Coupon Code Not Valid";
                $coupon_discount=0;
        }
    }

            $cartItem=Cart::where('user_id',Auth::guard('customerlogin')->id())->get();
            $c_product_price=0;
            foreach($cartItem as $item){
                $c_product_price+=$item->rel_to_product->discount_price* $item->quantity;
            }

       return view('Frontend.Cart.ViewCart',compact('cartItem','coupon_discount','message','c_product_price'));
   }

   function CartItemUpdateQuantity(Request $req){
        $condition=0;
        foreach($req->qtybutton as $cart_id=>$quantity){
           $product_id = Cart::find($cart_id)->product_id;
           $color_id = Cart::find($cart_id)->color_id;
           $size_id = Cart::find($cart_id)->size_id;
            $quantity_ase_kin= Inventory::where('product_id',$product_id)->where('color_id',$color_id)->where('size_id',$size_id)->first()->quantity;
            if($quantity_ase_kin > $quantity){
                Cart::find($cart_id)->update([
                    'quantity'=>$quantity
                ]);
                $condition=0;
            }else{
                $condition=1;
            }

        }
        if($condition == 0){
            return back()->with('quantityUpdate','cart quantity update successful');
        }else{
            return back()->with('quantityUpdate',"cart quantity Can't update ");
        }


   }
   function clearCart(){
       Cart::where('user_id',Auth::guard('customerlogin')->id())->delete();
       return back()->with('cartClear','Clear cart successful');

   }
}
