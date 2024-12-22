<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile($id){
        $category = CategoryModel::get();
        $users = User::where('id', $id)->first();
        return view('web.profile.profile',['id'=>$id , 'category'=>$category , 'users'=>$users]);
    }

    public function update(Request $request){
        $request->validate([
            'old_password' => 'required_with:password',
        ],[
          'old_password.required_with' => 'يرجى ادخال كلمة المرور القديمة',
        ]);

        $users = User::where('id', $request->id)->first();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->address = $request->address;
        if ($request->filled('password') && Hash::check($request->old_password, $users->password)) {
            $users->password = bcrypt($request->password);
        } elseif ($request->filled('password')) {
            return redirect()->back()->withErrors(['old_password' => 'The provided old password is incorrect.']);
        }

        $users->save();
        return redirect()->back()->with(['success'=>'تم تعديل بيانات المستخدم بنجاح']);
    }
}
