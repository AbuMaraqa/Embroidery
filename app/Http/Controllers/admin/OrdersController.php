<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItemsModel;
use App\Models\OrdersModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(){
        return view('admin.orders.index');
    }

    public function list_order(){
        $data = OrdersModel::whereIn('id',function($query){
            $query->select('order_id')->from('order_items')->whereIn('product_id',function($query){
                $query->select('id')->from('products')->where('user_id',3);
            });
        })->get();
        return view('admin.orders.order_list',['data'=>$data]);
    }

    public function order_details($id){
        $data = OrderItemsModel::with('product')->where('order_id',$id)->whereIn('product_id',function($query){
            $query->select('id')->from('products')->where('user_id',auth()->user()->id);
        })->get();
        return view('admin.orders.order_details',['data'=>$data]);
    }
}
