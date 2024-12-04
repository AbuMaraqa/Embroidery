<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\EmbroideryRequestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmbroideryController extends Controller
{
    public function new_embroidery(){
        $category = CategoryModel::get();
        return view('web.embroider.new_embroider',['category'=>$category]);
    }

    public function create_post(Request $request){
        $data = new EmbroideryRequestModel();
        $data->user_id = auth()->user()->id;
        $data->inserted_at = Carbon::now();
        $data->subject = $request->subject;
        $data->notes = $request->notes;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('embroidery_request', $filename, 'public');
            $data->image = $filename;
        }
        if($data->save()){
            return redirect()->route('web.embroidery.new_embroidery')->with(['success'=>'تم انشاء الطلب بنجاح']);
        }
    }
}
