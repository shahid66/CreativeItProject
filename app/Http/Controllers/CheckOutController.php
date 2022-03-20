<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    function checkOut(){
        $country=Country::all();
        $Cart=Cart::where('user_id',Auth::guard('customerlogin')->id())->get();
        return view('Frontend.Cart.CheckOut',compact('country','Cart'));
    }
    function getCity(Request $req){
        echo $req->country_id;

        $city=City::where('country_id',$req->country_id)->get();
        $str="<option>Select a City</option>";
        foreach($city as $city){
            $str .= '<option  value="'.$city->id.'">'.$city->name.'</option>';
        }
        echo $str;

    }

    function orderInsert(Request $req){
        $req->validate([
            'payment_method'=>['required'],
            'charge'=>['required'],
            'phone'=>['required'],
            'zip_code'=>['required'],
            'address'=>['required'],
            'city_id'=>['required'],
            'country_id'=>['required'],
            'email'=>['required'],
            'name'=>['required'],
        ]);

        $carts = Cart::where('user_id',Auth::guard('customerlogin')->id())->get();

        if($req->payment_method == 1){
            foreach($carts as $cart){
               $quantity_ase_kin= Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->quantity;
               $show_ase=$quantity_ase_kin-1;
               $size_ase_kin= Size::where('id',$cart->size_id)->first()->size_name;
                if($quantity_ase_kin>0){

                    if($quantity_ase_kin > $cart->quantity){
                        Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->decrement('quantity',$cart->quantity);

                        $cartItem=Cart::where('user_id',Auth::guard('customerlogin')->id())->get();
                        $c_product_price=0;
                        foreach($cartItem as $item){
                             $c_product_price+=$item->rel_to_product->discount_price* $item->quantity;
                        }
                        $final_price=$c_product_price-session('discount');
                        $discount_final=session('discount');
                        $delivery_charge=0;

                        if($req->charge == 1){
                            $delivery_charge=60;
                        }else if($req->charge == 2){
                            $delivery_charge=100;
                        }else{
                            $delivery_charge=100;
                        }

                        $order_id=Order::insertGetId([
                            'user_id'=>Auth::guard('customerlogin')->id(),
                            'sub_total'=>$c_product_price,
                            'discount'=>$discount_final,
                            'delivery_charge'=>$delivery_charge,
                            'total'=>$final_price+$delivery_charge,
                            'payment_method'=>$req->payment_method,
                            'created_at'=>Carbon::now()

                        ]);

                        BillingDetails::insert([
                            'order_id'=>$order_id,
                            'user_id'=>Auth::guard('customerlogin')->id(),
                            'name'=>$req->name,
                            'email'=>$req->email,
                            'company'=>$req->company_name,
                            'country_id'=>$req->country_id,
                            'city_id'=>$req->city_id,
                            'zip_code'=>$req->zip_code,
                            'address'=>$req->address,
                            'phone'=>$req->phone,
                            'notes'=>$req->notes,
                            'created_at'=>Carbon::now()


                        ]);
                        foreach($carts as $cart){
                            OrderProduct::insert([
                                'order_id'=>$order_id,
                                'product_id'=>$cart->product_id,
                                'product_price'=>$cart->rel_to_product->discount_price,
                                'color_id'=>$cart->color_id,
                                'size_id'=>$cart->size_id,
                                'quantity'=>$cart->quantity,
                                'created_at'=>Carbon::now()
                            ]);
                        }

                        $carts = Cart::where('user_id',Auth::guard('customerlogin')->id())->get();
                        foreach($carts as $cart){
                            Cart::find($cart->id)->delete();
                        }


                    return redirect()->route('congratulation');

                    }else{
                        return back()->with('quantity_nai',"you can buy $show_ase item in this $size_ase_kin Size. Please Update Cart ");

                    }
                }else{

                    return back()->with('quantity_nai',"Quantity nai");
                }
            }

        }


    }

    function congratulation(){
        return view('Frontend.Congratulation');
    }

    function orderAdminView(){
        $orders=Order::all();
        return view('Admin.Order.index',compact('orders'));
    }
}
