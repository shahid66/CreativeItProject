<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FilterProductController extends Controller
{
    function index(){
        return view('Frontend.FilterProduct.FilterProductShow');
    }

    function SearchByProductName(Request $req){
        $data=Product::fiend($req->keyName);
        return $data;
    }
}
