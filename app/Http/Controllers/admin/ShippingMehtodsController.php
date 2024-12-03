<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingAreasModel;
use Illuminate\Http\Request;

class ShippingMehtodsController extends Controller
{
    public function index(){
        $data = ShippingAreasModel::get();
        return view('admin.shipping_methods.index' , ['data'=>$data]);
    }

    public function add(){
        return view('admin.shipping_methods.add');
    }

    public function create(Request $request){
        $data = new ShippingAreasModel();
        $data->shipping_name = $request->shipping_name;
        $data->shipping_price = $request->shipping_price;
        if($data->save()){
            return redirect()->route('admin.shipping_methods.index')->with(['success'=>'تم انشاء طريقة الشحن بنجاح']);
        }
    }

    public function edit($id){
        $data = ShippingAreasModel::where('id',$id)->first();
        return view('admin.shipping_methods.edit',['data'=>$data]);
    }

    public function update(Request $request){
        $data = ShippingAreasModel::where('id',$request->id)->first();
        $data->shipping_name = $request->shipping_name;
        $data->shipping_price = $request->shipping_price;
        if($data->save()){
            return redirect()->route('admin.shipping_methods.index')->with(['success'=>'تم تعديل طريقة الشحن بنجاح']);
        }
    }

    public function delete($id){
        $data = ShippingAreasModel::where('id',$id)->first();
        if($data->delete()){
            return redirect()->route('admin.shipping_methods.index')->with(['success'=>'تم حذف طريقة الشحن بنجاح']);
        }
    }
}
