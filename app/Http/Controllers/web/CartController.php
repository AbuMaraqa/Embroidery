<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CartModel;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // الحصول على session_id
        $sessionId = session()->getId();

        // التحقق مما إذا كان المستخدم مسجل الدخول
        $userId = auth()->check() ? auth()->id() : null;

        // إضافة المنتج إلى السلة أو تحديث الكمية
        CartModel::updateOrCreate(
            [
                'session_id' => $sessionId,
                'product_id' => $productId,
                'user_id' => $userId
            ],
            [
                'qty' => DB::raw("qty + $quantity") // زيادة الكمية إذا كان المنتج موجودًا
            ]
        );

        return redirect()->back()->with(['success' => 'تمت الاضافة بنجاح']);
    }

    public function getCart()
    {
        $category = CategoryModel::get();
        $sessionId = session()->getId();
        $cartItems = CartModel::with('product')
            ->where(function ($query) use ($sessionId) {
                $query->where('session_id', $sessionId);
                if (auth()->check()) {
                    $query->orWhere('user_id', auth()->id());
                }
            })
            ->get();
            $totalPrice = $cartItems->sum(function ($cartItem) {
                return $cartItem->product->product_price * $cartItem->qty;
            });
        return view('web.cart.index' , ['cartItems' => $cartItems , 'category'=>$category , 'totalPrice'=>$totalPrice]);
    }

    public function removeFromCart(Request $request){
        $productId = request()->input('product_id');
        $sessionId = session()->getId();

        CartModel::where('product_id', $productId)
            ->where(function ($query) use ($sessionId) {
                $query->where('session_id', $sessionId);
                if (auth()->check()) {
                    $query->orWhere('user_id', auth()->id());
                }
            })
            ->delete();

        return redirect()->back()->with(['success' => 'تم حذف المنتج من السلة بنجاح']);
    }

public function transferCartToUser()
{
    if (!auth()->check()) {
        return;
    }

    $sessionId = session()->getId();

    CartModel::where('session_id', $sessionId)->update([
        'user_id' => auth()->id(),
        'session_id' => null,
    ]);
}
}
