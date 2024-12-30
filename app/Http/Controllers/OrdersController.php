<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\OrderItemsModel;
use App\Models\OrdersModel;
use App\Models\ProductModel;
use App\Models\ShippingAreasModel;
use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class OrdersController extends Controller
{
    public function get_orders()
    {
        $category = CategoryModel::get();
        $sessionId = session()->getId();
        $shipping_methods = ShippingAreasModel::get();
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
        return view('web.orders.new_order', ['cartItems' => $cartItems, 'category' => $category, 'totalPrice' => $totalPrice, 'shipping_methods' => $shipping_methods]);
    }



    public function processPayment(Request $request)
    {
        $sessionId = session()->getId();
        if ($request->payment_method == 'visa') {
            Stripe::setApiKey(config('stripe.sk'));
            $session = \Stripe\Checkout\Session::create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'ils',
                            'product_data' => [
                                'name' => 'Products',
                            ],
                            'unit_amount' => CartModel::where('user_id', auth()->user()->id)
    ->orWhere('session_id', $sessionId)
    ->get()
    ->sum(function ($cartItem) {
        return $cartItem->product->product_price * $cartItem->qty * 100; // ضرب المبلغ في 100
    }),
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('home'),
                'cancel_url' => route('home'),
            ]);
        }

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

        // حساب حصة الأدمن (20%)
        $adminShare = $totalPrice * 0.2;

        // إنشاء الطلب
        $order = new OrdersModel();
        $order->user_id = auth()->user()->id;
        $order->shipping_id = $request->shipping_method;
        $order->order_status = 1;
        $order->payment_status = 1;
        $order->total_price = $totalPrice;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->shipping_method = $request->shipping_method;
        $order->save();

        // توزيع المبالغ
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItemsModel();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cartItem->product_id;
            $orderItem->qty = $cartItem->qty;
            $orderItem->price = $cartItem->product->product_price * $cartItem->qty;
            $orderItem->name = $cartItem->name;
            $orderItem->save();

            $find_user = ProductModel::where('id', $cartItem->product_id)->first();
            $embroider = User::where('id', $find_user->user_id)->first();

            // حصة المنتج بعد خصم نسبة الأدمن
            $productShare = ($cartItem->product->product_price * $cartItem->qty) * 0.8;

            // تحديث مبلغ المتطريز
            $embroider->amount = $embroider->amount + $productShare;
            $embroider->save();
        }

        // حفظ حصة الأدمن (يمكن تخصيص جدول أو مستخدم معين للأدمن)
        $admin = User::where('user_role', 'admin')->first();
        if ($admin) {
            $admin->amount = $admin->amount + $adminShare;
            $admin->save();
        }

        CartModel::where('user_id', auth()->user()->id)->orWhere('session_id', $sessionId)->delete();

        return $request->payment_method == 'visa'
            ? redirect()->away($session->url)
            : redirect()->route('home');
    }
    public function cart_order_ajax(Request $request)
    {
        $category = CategoryModel::get();
        $sessionId = session()->getId();
        $shipping_methods = ShippingAreasModel::get();
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

        return response()->json([
            'success' => true,
            'view' => view('web.orders.ajax.cart_order', ['cartItems' => $cartItems, 'category' => $category, 'totalPrice' => $totalPrice, 'shipping_methods' => $shipping_methods])->render()
        ]);
    }

    public function update_qty(Request $request)
    {
        $sessionId = session()->getId();
        $data = CartModel::find($request->id);
        $data->qty = $request->qty;
        $data->save();
        // $cartItems = CartModel::with('product')
        //     ->where(function ($query) use ($sessionId) {
        //         $query->where('session_id', $sessionId);
        //         if (auth()->check()) {
        //             $query->orWhere('user_id', auth()->id());
        //         }
        //     })
        //     ->get();
        // $totalPrice = $cartItems->sum(function ($cartItem) {
        //     return $cartItem->product->product_price * $cartItem->qty;
        // });
        return response()->json([
            'success' => true,
            // 'view'=> view('web.orders.ajax.cart_order',['cartItems' => $cartItems, 'category' => $category, 'totalPrice' => $totalPrice])->render()
        ]);
    }

    public function update_name(Request $request)
    {
        $sessionId = session()->getId();
        $data = CartModel::find($request->id);
        $data->name = $request->name;
        $data->save();
        // $cartItems = CartModel::with('product')
        //     ->where(function ($query) use ($sessionId) {
        //         $query->where('session_id', $sessionId);
        //         if (auth()->check()) {
        //             $query->orWhere('user_id', auth()->id());
        //         }
        //     })
        //     ->get();
        // $totalPrice = $cartItems->sum(function ($cartItem) {
        //     return $cartItem->product->product_price * $cartItem->qty;
        // });
        return response()->json([
            'success' => true,
            // 'view'=> view('web.orders.ajax.cart_order',['cartItems' => $cartItems, 'category' => $category, 'totalPrice' => $totalPrice])->render()
        ]);
    }

    public function delete_cart_item_ajax(Request $request)
    {
        $data = CartModel::find($request->id);
        $data->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    public function my_orders()
    {
        $data = OrdersModel::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        $category = CategoryModel::get();
        return view('web.orders.my_order', ['data' => $data, 'category' => $category]);
    }

    public function order_details($id)
    {
        $data = OrdersModel::with('order_items')->where('id', $id)->first();
        $category = CategoryModel::get();
        return view('web.orders.order_details', ['data' => $data, 'category' => $category]);
    }

    public function update_status(Request $request){
        $data = OrdersModel::find($request->id);
        $data->order_status = $request->order_status;
        $data->save();
        return redirect()->route('admin.orders.list_order');
    }
}
