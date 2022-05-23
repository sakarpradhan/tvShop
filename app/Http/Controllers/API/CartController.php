<?php

namespace App\Http\Controllers\API;

use App\Helper\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Tv;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartController extends Controller
{
    // prepares cart response and calculates amount
    public function cartResponse()
    {
        $cartItems = UserHelper::getUserDetails()->cart;
        $total = 0;

        foreach ($cartItems as $item) {
            $total += ($item->quantity * $item->tv->price);
        }

        return $responseData = [
            'cart' => CartResource::collection(
                Cart::where('user_id', UserHelper::getUserDetails()->id)->get()
            ),
            'total' => $total
        ];
    }

    public function show()
    {
        $response = [
            'status' => 200,
            'message' => 'Cart data found.',
            'data' => $this->cartResponse()
        ];

        return response()->json($response);
    }

    public function store()
    {

        // if the product does not exist
        try {
            Tv::findOrFail(request('tv'));
        } catch (ModelNotFoundException $error) {
            $response = [
                'status' => 204,
                'message' => 'Product invalid or not found.',
                'data' => $this->cartResponse()
            ];

            return response()->json($response);
        }

        // if the same product exists in cart, add quantity
        // else create new entry
        $cartItems = UserHelper::getUserDetails()->cart;
        if ($cartItems->contains('tv_id', request('tv'))) {
            $cart_id = $cartItems->where('tv_id', request('tv'))->pluck('id');
            $this->update($cart_id);
        } else {
            $attributes = [
                'user_id' => UserHelper::getUserDetails()->id,
                'tv_id' => request('tv')
            ];
            Cart::create($attributes);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Product added to Cart',
            'data' => $this->cartResponse()
        ]);
    }

    public function update($cart)
    {
        $cart = Cart::findOrFail($cart)->first();
        $cart->quantity += 1;
        $cart->update();
    }

    public function destroy(Cart $cart)
    {
        try {
            $cart->delete();
        } catch (NotFoundHttpException $error) {
            $response = [
                'status' => 204,
                'message' => 'Cart Item invalid or not found.',
                'data' => $this->cartResponse()
            ];

            return response()->json($response);
        }

        $response = [
            'status' => 200,
            'message' => 'Product removed from Cart successfully.',
            'data' => $this->cartResponse()
        ];

        return response()->json($response);
    }

    public function checkout()
    {

    }
}
