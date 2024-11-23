<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Show the category product
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/******  2ffe2fd9-8fe9-4aeb-8f3c-af5ce816bbf2  *******/
    public function index($id)
    {
        $data = ProductModel::where('category_id',$id)->get();
        $category = CategoryModel::get();
        return view('web.category.index',['data'=>$data , 'category'=>$category]);
    }
}
