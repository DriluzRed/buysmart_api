<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;


class CartController extends Controller
{
    public function getCart()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->with('items.product')->first();
            $items = $cart ? $cart->items->map(function ($item) {
                return [
                    'id' => $item->product->id,
                    'name' => $item->product->name,
                    'price' => $item->product->sale_price,
                    'quantity' => $item->quantity,
                    'image_url' => asset('storage/' . $item->product->main_image)
                ];
            }) : [];
            return response()->json($items);
        } else {
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
            $items = collect($cart)->map(function ($item) {
                $product = Product::find($item['id']);
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->sale_price,
                    'quantity' => $item['quantity'],
                    'image_url' => asset('storage/' . $product->main_image)
                ];
            });
            return response()->json($items);
        }
    }

    public function addToCart(Request $request)
    {
        $itemData = $request->input('item');
        $product = Product::find($itemData['id']);
        $totalStock = $product->stock->quantity;
        if ($totalStock == 0) {
            return response()->json(['success' => false, 'message' => 'Producto agotado']);
        }

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $cartItem = $cart->items()->where('product_id', $itemData['id'])->first();

            if ($cartItem) {
                if ($cartItem->quantity + 1 > $totalStock) {
                    return response()->json(['success' => false, 'message' => 'No hay suficiente stock disponible']);
                }
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                $cart->items()->create([
                    'product_id' => $itemData['id'],
                    'quantity' => 1
                ]);
            }
        } else {
            $cart = json_decode($request->cookie('cart'), true) ?? [];
            $found = false;
            foreach ($cart as &$item) {
                if ($item['id'] == $itemData['id']) {
                    if ($item['quantity'] + 1 > $totalStock) {
                        return response()->json(['success' => false, 'message' => 'No hay suficiente stock disponible']);
                    }
                    $item['quantity']++;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $itemData['quantity'] = 1;
                $cart[] = $itemData;
            }
            return response()->json(['success' => true, $cart])->cookie('cart', json_encode($cart), 60 * 24 * 30);
        }

        return response()->json(['success' => true]);
    }

    public function updateCartItem(Request $request)
    {
        $itemId = $request->input('item_id');
        $quantityChange = $request->input('quantity_change');
        $product = Product::find($itemId);

        // Verificar si hay stock disponible
        $totalStock = $product->stock->quantity;

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            $cartItem = $cart->items()->where('product_id', $itemId)->first();
            if ($cartItem) {
                // Verificar si la cantidad en el carrito más la cantidad solicitada supera el stock disponible
                if ($cartItem->quantity + $quantityChange > $totalStock) {
                    return response()->json(['success' => false, 'message' => 'No hay suficiente stock disponible']);
                }
                $cartItem->quantity += $quantityChange;
                if ($cartItem->quantity <= 0) {
                    $cartItem->delete();
                } else {
                    $cartItem->save();
                }
            }
        } else {
            $cart = json_decode($request->cookie('cart'), true) ?? [];
            foreach ($cart as &$item) {
                if ($item['id'] == $itemId) {
                    // Verificar si la cantidad en el carrito más la cantidad solicitada supera el stock disponible
                    if ($item['quantity'] + $quantityChange > $totalStock) {
                        return response()->json(['success' => false, 'message' => 'No hay suficiente stock disponible']);
                    }
                    $item['quantity'] += $quantityChange;
                    if ($item['quantity'] <= 0) {
                        $cart = array_filter($cart, function($item) use ($itemId) {
                            return $item['id'] !== $itemId;
                        });
                    }
                    break;
                }
            }
            return response()->json(['success' => true, $cart])->cookie('cart', json_encode($cart), 60 * 24 * 30);
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