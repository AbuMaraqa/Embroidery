<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('admin.product.index');
    }

    public function list_product_ajax(Request $request){

    }

    public function add(){
        return view('admin.product.add');
    }



    public function update(){

    }
}
