<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function getCart(Request $request)
    {
        if(Auth::check()){
            $cart = Cart::where('user_id', Auth::id())->with('items')->first();
            return response()->json($cart ? $cart->items : []);
        }else{
            return response()->json(json_decode(request()->cookie('cart'), true) ?? []);
        }
    }

    public function addToCart(Request $request){
        $itemData = $request->input('item');

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $cartItem = $cart->items()->updateOrCreate(
                ['product_id' => $itemData['id']],
                ['quantity' => DB::raw('quantity + 1')]
            );
        } else {
            $cart = json_decode($request->cookie('cart'), true) ?? [];
            $found = false;
            foreach ($cart as &$item) {
                if ($item['id'] == $itemData['id']) {
                    $item['quantity']++;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $itemData['quantity'] = 1;
                $cart[] = $itemData;
            }
            return response()->json($cart)->cookie('cart', json_encode($cart), 60 * 24 * 30);
        }

        return response()->json(['success' => true]);
    }

    public function removeFromCart(Request $request)
    {
        $itemId = $request->input('item_id');

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            $cart->items()->where('product_id', $itemId)->delete();
        } else {
            $cart = json_decode($request->cookie('cart'), true) ?? [];
            $cart = array_filter($cart, function($item) use ($itemId) {
                return $item['id'] !== $itemId;
            });
            return response()->json($cart)->cookie('cart', json_encode($cart), 60 * 24 * 30);
        }

        return response()->json(['success' => true]);
    }
}
