<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = CategoryModel::get();
        return view('admin.category.index',['data'=>$data]);
    }

    public function add()
    {
        return view('admin.category.add');
    }

    public function create(CategoryRequest $request)
    {
        $data = new CategoryModel();
        $data->category_name = $request->category_name;
        if($data->save()){
            return redirect()->route('admin.category.index')->with(['success'=>'تم انشاء القسم بنجاح']);
        }
    }

    public function edit($id)
    {
        $data = CategoryModel::where('id',$id)->first();
        return view('admin.category.edit',['data'=>$data]);
    }

    public function update(CategoryRequest $request)
    {
        $data = CategoryModel::where('id',$request->id)->first();
        $data->category_name = $request->category_name;
        if($data->save()){
            return redirect()->route('admin.category.index')->with(['success'=>'تم تعديل القسم بنجاح']);
        }
    }
}
