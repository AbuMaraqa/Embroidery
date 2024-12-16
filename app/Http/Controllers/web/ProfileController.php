<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile($id){
        $category = CategoryModel::get();
        $users = User::where('id', $id)->first();
        return view('web.profile.profile',['id'=>$id , 'category'=>$category , 'users'=>$users]);
    }

    public function update(Request $request){
        $users = User::where('id', $request->id)->first();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->address = $request->address;
        $users->save();
        return redirect()->back()->with(['success'=>'تم تعديل بيانات المستخدم بنجاح']);
    }
}
