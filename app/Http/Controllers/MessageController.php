<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\MessageModel;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index($id)
    {
        // Fetch messages where the authenticated user is either the sender or receiver
        $data = MessageModel::where(function ($query) use ($id) {
            $query->where('sender', auth()->user()->id)
                ->where('receive', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender', $id)
                ->where('receive', auth()->user()->id);
        })->orderBy('created_at', 'asc') // Order by message time
            ->get();

        // Fetch all categories (if needed for the view)
        $category = CategoryModel::all();

        return view('web.message.index', [
            'data' => $data,
            'category' => $category,
            'id' => $id
        ]);
    }

    public function create(Request $request)
    {
        $data = new MessageModel();
        $data->sender = auth()->user()->id;
        $data->receive = $request->receive;
        $data->message = $request->message;
        $data->save();
        return redirect()->back()->with(['success' => 'تم ارسال الرسالة بنجاح']);
    }

    public function list_message()
    {
        $data = MessageModel::with('sender_name')->where('receive', auth()->user()->id)->get();
        $category = CategoryModel::get();
        return view('web.message.list_users', ['data' => $data, 'category' => $category]);
    }
}
