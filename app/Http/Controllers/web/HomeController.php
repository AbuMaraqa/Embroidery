<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = ProductModel::get();
        $category = CategoryModel::get();
        return view('web.home',['products'=>$products , 'category'=>$category]);
    }
}
