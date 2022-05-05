<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // show all
    public function index()
    {
        $cartItems = auth()->user()->cart;
        $total = 0;

        foreach ($cartItems as $item)
        {
            $total += ($item->quantity * $item->tv->price);
        }

        return view('tvshop.cart.index', [
            'carts' => $cartItems,
            'total' => $total
        ]);
    }

    // create new record
    public function store()
    {
        $userCart = auth()->user()->cart;
        if ($userCart->contains('tv_id', request('tv'))) {
            $cart_id = $userCart->where('tv_id', request('tv'))->pluck('id');
            $this->update($cart_id);
        } else {
            $attributes = [
                'user_id' => auth()->user()->id,
                'tv_id' => request('tv')
            ];
            Cart::create($attributes);
        }
        return back()->with('success', 'TV added to the cart.');
    }

    // updates the quantity in the cart record
    protected function update($cart)
    {
        $cart = Cart::find($cart)->first();
        $cart->quantity += 1;
        $cart->update();
    }

    // delete the record
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with('success', 'Item removed from Cart');
    }

    // customer buys, cart is cleared
    public function checkout()
    {
        foreach (auth()->user()->cart as $cart)
        {
            $cart->delete();
        }
        return redirect('/')->with('success', 'Thank you for your purchase.');
    }
}
