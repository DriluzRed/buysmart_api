<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Helpers\Helper;
use App\Mail\OrderCreated;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function checkout()
    {
        $items = [];
        $customer = auth()->guard('customer')->user();
        $cart = Cart::where('customer_id', $customer->id)->first();
        if(!$cart) {
            return redirect()->back()->with('error', 'No hay productos en el carrito');
        }
        $cartItems = $cart->items;
        $total = 0;
        foreach($cartItems as $item) {
            $price = $item->product->is_on_sale ? $item->product->sale_price : $item->product->price;
            $total += $price * $item->quantity;
            $items [] = [
                'id' => $item->product->id,
                'name' => $item->product->name,
                'price' => $price,
                'quantity' => $item->quantity,
                'total' => $price * $item->quantity,
                'image' => $item->product->main_image,
            ];
        }
        $total += Helper::getDeliveryCost();
        return view('frontend.checkout.checkout', ['items' => $items, 'total' => $total]);
    }

    public function directCheckout($id, $quantity)
    {
        $delivery = Helper::getDeliveryCost();
        $product = Product::find($id);
        if(!isset($product->stock->quantity)) {
            return redirect()->back()->with('error', 'Producto no disponible');
        }
        $price = $product->is_on_sale ? $product->sale_price : $product->price;
        $total = ($price * $quantity) + $delivery;
        return view('frontend.checkout.checkout_direct', ['product' => $product, 'quantity' => $quantity, 'total' => $total,'price' => $price]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->type == 'direct'){
            $orderItems = [];
            $order = new Order();
            $order->customer_id = auth()->guard('customer')->user()->id;
            $order->status = 'pending';
            $order->payment_method_id = $request->payment_method;
            $order->address_id = $request->address;
            $order->subtotal = $request->total - Helper::getDeliveryCost();
            $order->total = $request->total;
            $order->additional_charges = 0;
            $order->save();

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $request->product_id;
            $orderItem->quantity = 1;
            $orderItem->price = $request->total - Helper::getDeliveryCost();
            $orderItem->save();
            $orderItems [] = [
                'item_name' => $orderItem->product->name,
                'quantity' => 1,
                'price' => $request->total - Helper::getDeliveryCost(),
            ];
            $customer_mail = $order->customer->email;
            $data_for_mail = [
                'order' => $order,
                'orderItem' => $orderItems,
            ];
            Mail::to($customer_mail)->send(new OrderCreated($data_for_mail));
            return response()->json([
                'success' => true,
                'redirect_url' => route('order.success', ['id' => $order->id])
            ]);
        }
        $customer = auth()->guard('customer')->user();
        $cart = Cart::where('customer_id', $customer->id)->first();
        if(!$cart) {
            return redirect()->back()->with('error', 'No hay productos en el carrito');
        }
        $cartItems = $cart->items;
        $orderItems = [];
        $order = new Order();
        $order->customer_id = $customer->id;
        $order->status = 'pending';
        $order->payment_method_id = $request->payment_method;
        $order->address_id = $request->address;
        $order->subtotal = $request->total - Helper::getDeliveryCost();
        $order->total = $request->total;
        $order->additional_charges = 0;
        $order->save();
        foreach($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->quantity = $item->quantity;
            $price = $item->product->is_on_sale ? $item->product->sale_price : $item->product->price;
            $orderItem->price = $price;
            $orderItem->save();
            $orderItems [] = [
                'item_name' => $orderItem->product->name,
                'quantity' => $item->quantity,
                'price' => $price,
            ];
        }
        $customer_mail = $order->customer->email;
        $data_for_mail = [
            'order' => $order,
            'orderItem' => $orderItems,
        ];
        Mail::to($customer_mail)->send(new OrderCreated($data_for_mail));
        $cart->items()->delete();
        $cart->delete();
        return response()->json([
            'success' => true,
            'redirect_url' => route('order.success', ['id' => $order->id])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
