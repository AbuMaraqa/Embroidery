<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('admin.product.index');
    }

    public function list_product_ajax(Request $request){
        $data = ProductModel::get();
        return response()->json([
            'success'=>true,
            'view'=>view('admin.product.ajax.product_list_ajax',['data'=>$data])->render(),
        ]);
    }

    public function add(){
        $category = CategoryModel::get();
        return view('admin.product.add',['category'=>$category]);
    }

    public function create(ProductRequest $request){
        $data = new ProductModel();
        $data->product_name = $request->product_name;
        $data->product_price = $request->product_price;
        $data->category_id = $request->category_id;
        $data->product_description = $request->product_description;
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('product', $filename, 'public');
            $data->product_image = $filename;
        }
        if($data->save()){
            return redirect()->route('admin.products.index')->with(['success'=>'تم انشاء المنتج بنجاح']);
        }
    }

    public function edit($id){
        $data = ProductModel::where('id',$id)->first();
        $category = CategoryModel::get();
        return view('admin.product.edit',['data'=>$data,'category'=>$category]);
    }

    public function update(ProductRequest $request){
        $data = ProductModel::where('id',$request->id)->first();
        $data->product_name = $request->product_name;
        $data->product_price = $request->product_price;
        $data->category_id = $request->category_id;
        $data->product_description = $request->product_description;
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('product', $filename, 'public');
            $data->product_image = $filename;
        }
        if($data->save()){
            return redirect()->route('admin.products.index')->with(['success'=>'تم انشاء المنتج بنجاح']);
        }
    }

    public function delete($id){
        $data = ProductModel::where('id',$id)->first();
        if($data->delete()){
            return redirect()->route('admin.products.index')->with(['success'=>'تم حذف المنتج بنجاح']);
        }
    }
}
