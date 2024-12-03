<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\OrderItemsModel;
use App\Models\OrdersModel;
use App\Models\ShippingAreasModel;
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
    if($request->payment_method == 'visa'){
        Stripe::setApiKey(config('stripe.sk'));
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'ils',
                        'product_data' => [
                            'name' => 'Products',
                        ],
                        'unit_amount' => CartModel::where('user_id', auth()->user()->id)->orWhere('session_id', $sessionId)
                        ->get()
                        ->sum(function ($cartItem) {
                            return $cartItem->product->product_price * $cartItem->qty;
                        }),
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('home'),
            'cancel_url' => route('home'),
        ]);

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

    $order = new OrdersModel();
    $order->user_id = auth()->user()->id;
    $order->order_status = 1;
    $order->payment_status = 1;
    $order->total_price =  $totalPrice;
    $order->address =  $request->address;
    $order->shipping_method =  $request->shipping_method;
    $order->total_price =  $totalPrice;
    if($order->save()){
        foreach($cartItems as $cartItem){
         $orderItem = new OrderItemsModel();
         $orderItem->order_id = $order->id;
         $orderItem->product_id = $cartItem->product_id;
         $orderItem->qty = $cartItem->qty;
         $orderItem->price = $cartItem->product->product_price * $cartItem->qty;
         $orderItem->save();
        }

        CartModel::where('user_id', auth()->user()->id)->orWhere('session_id', $sessionId)->delete();
    }
    return redirect()->away($session->url);

    }
    else{
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

    $order = new OrdersModel();
    $order->user_id = auth()->user()->id;
    $order->order_status = 1;
    $order->payment_status = 1;
    $order->total_price =  $totalPrice;
    $order->address =  $request->address;
    $order->shipping_method =  $request->shipping_method;
    $order->total_price =  $totalPrice;
    if($order->save()){
        foreach($cartItems as $cartItem){
         $orderItem = new OrderItemsModel();
         $orderItem->order_id = $order->id;
         $orderItem->product_id = $cartItem->product_id;
         $orderItem->qty = $cartItem->qty;
         $orderItem->price = $cartItem->product->product_price * $cartItem->qty;
         $orderItem->save();
        }

        CartModel::where('user_id', auth()->user()->id)->orWhere('session_id', $sessionId)->delete();
    }
    return redirect()->route('home');
    }
}

public function cart_order_ajax(Request $request){
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
        'view'=> view('web.orders.ajax.cart_order',['cartItems' => $cartItems, 'category' => $category, 'totalPrice' => $totalPrice, 'shipping_methods' => $shipping_methods])->render()
    ]);
}

public function update_qty(Request $request){
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

public function delete_cart_item_ajax(Request $request){
    $data = CartModel::find($request->id);
    $data->delete();
    return response()->json([
        'success' => true,
    ]);
}

public function my_orders(){
    $data = OrdersModel::where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
    $category = CategoryModel::get();
    return view('web.orders.my_order',['data'=>$data , 'category'=>$category]);
}
}
