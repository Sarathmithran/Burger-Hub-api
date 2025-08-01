<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CartController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('menu')->get();

        // Add image_url to each menu
        $cartItems->each(function ($item) {
            $item->menu->image = $item->menu->image_url;
        });
        
        return response()->json($cartItems);
    }

    public function storeOrUpdateCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('menu_id', $request->menu_id)
            ->first();

        if ($cartItem) {
            // If the item exists, add the quantity
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
            $message = 'Cart item updated';
        } else {
            // Otherwise, create a new cart item
            $cartItem = Cart::create([
                'user_id' => Auth::id(),
                'menu_id' => $request->menu_id,
                'quantity' => $request->quantity,
            ]);
            $message = 'Item added to cart';
        }

        return response()->json(['message' => $message, 'cart_item' => $cartItem]);
    }

    public function removeFromCart(Cart $cart)
    {
        $this->authorize('delete', $cart);

        $cart->delete();
        return response()->json(['message' => 'Item removed from cart']);
    }
}