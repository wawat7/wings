<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Cart\CreateCartRequest;
use App\Http\Requests\API\UpdateCartRequest;
use App\Http\Resources\API\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartController extends Controller
{
    public function all(Request $request)
    {
        $carts = Cart::with('product');

        if ($request->has('user_id')) {
            $carts = $carts->whereUserId($request->user_id);
        }

        $carts = $carts->get();
        return response()->json(CartResource::collection($carts), 200);
    }

    public function create(CreateCartRequest $request)
    {
        $cart = Cart::whereProductId($request->product_id)->whereUserId($request->user_id)->first();
        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return response()->json([
            'success' => true
        ], 200);
    }

    public function update(UpdateCartRequest $request, $cartId)
    {
        $cart = Cart::find($cartId);
        if (!$cart) {
            throw new NotFoundHttpException("product cart not found");
        }

        if ($request->quantity < 1) {
            $cart->delete();
        } else{
            $cart->quantity = $request->quantity;
            $cart->save();
        }

        return response()->json([
            'success' => true
        ], 200);
    }

    public function delete($cartId)
    {
        Cart::destroy($cartId);
        return response()->json([
            'success' => true
        ], 200);
    }
}
