<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id)
    {
        $data = ProductModel::where('category_id',$id)->get();
        $category = CategoryModel::get();
        return view('web.category.index',['data'=>$data , 'category'=>$category]);
    }
}
