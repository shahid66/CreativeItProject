<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    function getCustomer($customer_id){
        $customer_data=CustomerLogin::find($customer_id);
        $orders=Order::where('user_id',Auth::guard('customerlogin')->id())->get();
        return view('Frontend.Customer.CustomerDashboard',compact('customer_data','orders'));
    }
}
