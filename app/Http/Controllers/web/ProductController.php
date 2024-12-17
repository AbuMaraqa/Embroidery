<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($id)
    {
        $data = ProductModel::where('id',$id)->first();
        $category = CategoryModel::get();
        return view('web.product.index' , ['data'=>$data , 'category'=>$category]);
    }
}
