<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Models\CategoryModel;
use App\Models\SubcategoryModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
    function Index(){
        $AllSubCategory=SubcategoryModel::all();
        $AllCategory=CategoryModel::all();
        $AllTrashSubCategory=SubcategoryModel::onlyTrashed()->get();
        return view('Admin.SubCategory.index',compact('AllSubCategory','AllCategory','AllTrashSubCategory'));
    }

    function Insert(SubCategoryRequest $req){

if(SubcategoryModel::withTrashed()->where('category_id',$req->category_id)->where('sub_category_name',$req->sub_category_name)->exists()){
    return back()->with('exists','Sub category name already added under this category');
}else{
    SubcategoryModel::insert([
        'category_id'=>$req->category_id,
        'added_by'=>Auth::id(),
        'sub_category_name'=>$req->sub_category_name,

        'created_at'=>Carbon::now()
    ]);
    return back()->with('insert','Add Hoise');
}


    }
    function Delete($cat_id){
        SubcategoryModel::find($cat_id)->delete();
        return back()->with('soft_delete','Soft Delete Hoise');
    }

    function PermanentDelete($cat_id){
        SubcategoryModel::onlyTrashed()->find($cat_id)->forceDelete();
        return back()->with('delete','Delete Hoise');
    }

    function Restore($cat_id){
        SubcategoryModel::onlyTrashed()->find($cat_id)->restore();
        return back()->with('restore','Restore Hoise');
    }
    function Edit($cat_id){
        $AllCategory=CategoryModel::all();
        $SubCategory_id=SubcategoryModel::find($cat_id);
        return view('Admin.SubCategory.edit',compact('SubCategory_id','AllCategory'));
    }

    function Update(SubCategoryRequest $req){

//     echo $req->sub_category_name;
//     echo SubcategoryModel::find($req->cat_id);
// die();
SubcategoryModel::where('id',$req->cat_id)->update([
            'category_id'=>$req->category_id,
            'added_by'=>Auth::id(),
            'sub_category_name'=>$req->sub_category_name,
            'updated_at'=>Carbon::now()
        ]);
        return redirect('/subcategory')->with('update','Update Hoise');
    }
}
