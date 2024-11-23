<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SliderModel;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $data = SliderModel::get();
        return view('admin.slider.index',['data'=>$data]);
    }

    public function add(){
        return view('admin.slider.add');
    }

    public function create(Request $request){
        $data = new SliderModel();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('slider', $filename, 'public');
            $data->image = $filename;
        }
        if($data->save()){
            return redirect()->route('admin.slider.index')->with(['success'=>'تم انشاء الصورة بنجاح']);
        }
    }
}
