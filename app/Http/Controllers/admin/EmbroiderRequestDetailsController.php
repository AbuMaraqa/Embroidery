<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EmbroideryRequestModel;
use Illuminate\Http\Request;

class EmbroiderRequestDetailsController extends Controller
{
    public function index(){
        $data = EmbroideryRequestModel::get();
        return view('admin.embroider_request_submit.index' , ['data'=>$data]);
    }
}
