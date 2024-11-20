<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::get();
        return view('admin.users.index',['data' => $data]);
    }

    public function add(){
        return view('admin.users.add');
    }

    public function create(UserRequest $request){
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->num_of_card = $request->num_of_card;
        $data->information = $request->information;
        $data->user_role = $request->user_role;
        if($data->save()){
            return redirect()->route('admin.users.index')->with(['success'=>'تم انشاء المستخدم بنجاح']);
        }
    }

    public function edit($id){
        $data = User::where('id',$id)->first();
        return view('admin.users.edit',['data'=>$data]);
    }

    public function update(UserRequest $request){
        $data = User::where('id',$request->id)->first();
        $data->name = $request->name;
        $data->email = $request->email;
        if($request->filled('password')){
            $data->password = bcrypt($request->password);
        }
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->num_of_card = $request->num_of_card;
        $data->information = $request->information;
        $data->user_role = $request->user_role;
        if($data->save()){
            return redirect()->route('admin.users.index')->with(['success'=>'تم تعديل بيانات المستخدم بنجاح']);
        }
    }
}
