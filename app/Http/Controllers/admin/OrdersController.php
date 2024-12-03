<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OrdersModel;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(){
        return view('admin.orders.index');
    }
}
