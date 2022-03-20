<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\CategoryModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function Index(){
        $AllCategory=CategoryModel::all();
        return view('Admin.Category.index',compact('AllCategory'));
    }

    function Insert(CategoryRequest $req){



        $insert_id=CategoryModel::insertGetId([
            'category_name'=>$req->category_name,
            'added_by'=>Auth::id(),
            'created_at'=>Carbon::now()
        ]);
        $image=$req->category_image;
        $image_extension=$image->getClientOriginalExtension();
        $new_name=$insert_id.'.'.$image_extension;
        Image::make($image)->resize(800,800)->save(public_path('uploads/category/images/').$new_name);

        CategoryModel::find($insert_id)->Update([
            'category_image'=>$new_name
        ]);


        return back()->with('insert','Add Hoise');
    }
    function Delete($cat_id){

        $image_name=CategoryModel::where('id',$cat_id)->first();

        $path= public_path("uploads/category/images/"). $image_name->category_image;

        unlink($path);
        CategoryModel::find($cat_id)->delete();

        return back()->with('delete','Delete Hoise');
    }
    function Edit($cat_id){
        $Category_id=CategoryModel::find($cat_id);
        return view('Admin.Category.edit',compact('Category_id'));
    }

    function Update(CategoryRequest $req){


//     echo $req->category_name_edit;
//     echo CategoryModel::find($req->cat_id);
// die();
        CategoryModel::where('id',$req->cat_id)->update([
            'category_name'=>$req->category_name,

            'added_by'=>Auth::id(),
            'created_at'=>Carbon::now()
        ]);
        return redirect('/category')->with('update','Update Hoise');
    }


    function UpdateImage(Request $req){
        $req->validate([
            'category_image'=>['required']
        ]);
        $image_name=CategoryModel::where('id',$req->cat_id)->first();

        $path= public_path("uploads/category/images/").$image_name->category_image;

        if(is_file($path)){
            unlink($path);

            $new_image=$req->category_image;

            $extension=$new_image->getClientOriginalExtension();

            $new_name_Image=$req->cat_id.'.'.$extension;
            Image::make($new_image)->resize(800,800)->save(base_path('public/uploads/category/images/'.$new_name_Image));
            CategoryModel::where('id',$req->cat_id)->update([

                'category_image'=>$new_name_Image,

            ]);
        }else{
            $new_image=$req->category_image;

            $extension=$new_image->getClientOriginalExtension();

            $new_name_Image=$req->cat_id.'.'.$extension;
            Image::make($new_image)->resize(800,800)->save(base_path('public/uploads/category/images/'.$new_name_Image));
            CategoryModel::where('id',$req->cat_id)->update([

                'category_image'=>$new_name_Image,

            ]);
        }

        return back()->with('cat_image_update','category image update hoise');
    }
}
