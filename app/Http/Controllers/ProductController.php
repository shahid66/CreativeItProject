<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductThumbnail;
use App\Models\Size;
use App\Models\SubcategoryModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function Index(){
        $allCategory=CategoryModel::all();
        $allSubCategory=SubcategoryModel::all();
        $allProduct=Product::all();
        return view('Admin.Products.Index',compact('allCategory','allSubCategory','allProduct'));
    }
    function InventoryIndex($product_id){
        $product=Product::find($product_id);
        $color=color::all();
        $Size=Size::all();
        $AllInventory=Inventory::all();
        return view('Admin.Products.Inventory',compact('product','color','Size','AllInventory'));
    }

    function InventoryInsert(Request $req){
        $req->validate([
            'product_id'=>['required'],
            'color_id'=>['required'],
            'size_id'=>['required'],
            'product_quantity'=>['required'],
        ]);

        if(Inventory::where('product_id',$req->product_id)->where('color_id',$req->color_id)->where('size_id',$req->size_id)->exists()){

            Inventory::where('product_id',$req->product_id)->where('color_id',$req->color_id)->where('size_id',$req->size_id)->increment('quantity',$req->product_quantity);
            return back()->with('inventoryInsert','Inventory Quantity add hoise');

        }else{
            Inventory::insert([
                'product_id'=>$req->product_id,
                'color_id'=>$req->color_id,
                'size_id'=>$req->size_id,
                'quantity'=>$req->product_quantity,
                'created_at'=>Carbon::now()
            ]);

            return back()->with('inventoryInsert','Inventory add hoise');
        }


    }
    function InventoryDelete($inventory_id){
        Inventory::find($inventory_id)->delete();
        return back()->with('inv_delete','Inventory Item delete ');

    }

    function ColorSize(){
        $AllColor=color::all();
        $AllSize=Size::all();
        return view('Admin.Products.Color_Size',compact('AllColor','AllSize'));
    }
    function ColorInsert(Request $req){
        $req->validate([
            'color_name'=>'unique:colors'
        ]);

        color::insert([
            'color_name'=>$req->color_name,
            'color_code'=>$req->color_code,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('colorInsert','Color Insert Successful');

    }
    function SizeInsert(Request $req){
        $req->validate([
            'size_name'=>'unique:sizes'
        ]);
        Size::insert([
            'size_name'=>$req->size_name,
            'created_at'=>Carbon::now(),

        ]);
        return back()->with('colorInsert','Color Insert Successful');

    }

    function getSubCategory(Request $req){

        $SelectedsubCategory=SubcategoryModel::where('category_id',$req->category_id)->select('id','sub_category_name')->get();
        $str_to_send='<option>--SELECT--</option>';

        foreach($SelectedsubCategory as $item){
            $str_to_send.='<option value="'.$item->id.'">'.$item->sub_category_name.'</option>';
        }
        echo $str_to_send;
    }

    function ProductInsert(Request $req){
        $req->validate([
            'product_name'=>['required'],
            'category_id'=>['required'],
            'sub_category_id'=>['required'],
            'product_price'=>['required'],
            'discount_percent'=>['required'],
            'description'=>['required'],
            'image'=>['required'],
            'image_thumbnails'=>['required'],
        ]);
        $product_id=Product::insertGetId([
            'product_name'=>$req->product_name,
            'category_id'=>$req->category_id,
            'subcategory_id'=>$req->sub_category_id,
            'product_price'=>$req->product_price,
            'discount'=>$req->discount_percent,
            'discount_price'=>$req->product_price - ($req->product_price * $req->discount_percent)/100,
            'description'=>$req->description,

        ]);

        $product_image=$req->image;
        $extension=$product_image->getClientOriginalExtension();
        $new_name= $product_id.'.'.$extension;

        Image::make($product_image)->resize(800, 800)->save(public_path('uploads/products/preview/').$new_name);

        Product::find($product_id)->update([
            'product_image'=>$new_name
        ]);


        $start=1;
        foreach($req->image_thumbnails as $item){

        $extension=$item->getClientOriginalExtension();
        $new_name_thumbnail= $product_id.'-'.$start.'.'.$extension;

        Image::make( $item)->resize(800, 800)->save(public_path('uploads/products/thumbnails/').$new_name_thumbnail);
        ProductThumbnail::insert([
            'product_id'=>$product_id,
            'thumbnail_name'=>$new_name_thumbnail
        ]);

        $start++;
        }

        return back();
    }
}
