<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\EmbroideryRequestModel;
use App\Models\EmbroideryRequestSubmitModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmbroideryRequestController extends Controller
{
    public function create(Request $request){
        $data = new EmbroideryRequestSubmitModel();
        $data->embroidery_request_id = $request->id;
        $data->user_id = auth()->user()->id;
        $data->inserted_at = Carbon::now();
        $data->notes = $request->notes;
        $data->price = $request->price;
        if($data->save()){
            return redirect()->back()->with(['success'=>'تم ارسال الطلب بنجاح']);
        }
    }

    public function embroidery_request_index(){
        $data = EmbroideryRequestModel::with('embroider')->where('user_id',auth()->user()->id)->get();
        $category = CategoryModel::get();
        return view('web.embroider.embroider_request_submit',['data'=>$data , 'category'=>$category]);
    }

    public function embroidery_request_details($id){
        $data = EmbroideryRequestSubmitModel::where('embroidery_request_id',$id)->get();
        $category = CategoryModel::get();
        return view('web.embroider.embroider_request_details',['data'=>$data , 'category'=>$category]);
    }

    public function accept_embroidery(Request $request){
        $data = EmbroideryRequestModel::where('id',$request->id)->first();
        $data->accept_embroider = $request->user_id;
        $data->save();
        return redirect()->route('web.embroidery_request.embroidery_request_index')->with(['success'=>'تم قبول الطلب بنجاح']);
    }
}
