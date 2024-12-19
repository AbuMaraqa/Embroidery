<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\MessageModel;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index($id){
        $data = MessageModel::where('sender',auth()->user()->id)->where('receive',$id)->get();
        $category = CategoryModel::get();
        return view('web.message.index' , ['data'=>$data , 'category'=>$category , 'id'=>$id]);
    }

    public function create(Request $request){
        $data = new MessageModel();
        $data->sender = auth()->user()->id;
        $data->receive = $request->receive;
        $data->message = $request->message;
        $data->save();
        return redirect()->back()->with(['success'=>'تم ارسال الرسالة بنجاح']);
    }
}
