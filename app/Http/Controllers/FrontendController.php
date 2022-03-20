<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function Index(){

        $all_category=CategoryModel::all();
        $all_product=Product::all();
        $new_product=Product::latest()->take(6)->get();
        $top_category=CategoryModel::take(3)->get();

        return view('Frontend.index',[
            'all_category'=>$all_category,
            'all_product'=>$all_product,
            'top_category'=>$top_category,
            'new_product'=>$new_product,
        ]);
    }
    function product_details($product_id){
       $product_details=Product::find($product_id);
       $available_color=Inventory::where('product_id',$product_id)->groupBy('color_id')->selectRaw('count(*) as total,color_id')->get();
       return view('Frontend.product_details',[
        'product_details'=>$product_details,
        'available_color'=>$available_color,
       ]);
    }
    function getSize(Request $req){
        $size= Inventory::where('product_id',$req->product_id)->where('color_id',$req->color_id)->get('size_id');
        // $quantity_available= Inventory::where('product_id',$req->product_id)->where('color_id',$req->color_id)->first()->quantity;



        $size_item='';
        foreach($size as $size){
            $size_name_variable=Size::find($size->size_id)->size_name;
            $size_item .='<li><a class="size_id"  name="'.$size->size_id.'" selected>'.$size_name_variable.'</a></li>';
        }
        echo $size_item;
    }
    function getQuantityAvailable(Request $req){
        $quantity_available= Inventory::where('product_id',$req->product_id)->where('color_id',$req->color_id)->where('size_id',$req->size_id)->first()->quantity;
        echo $quantity_available;
    }
}
