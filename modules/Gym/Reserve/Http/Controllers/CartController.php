<?php

namespace Gym\Reserve\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Reserve\Models\Cart;
use Gym\Reserve\Models\Reserve;
use Gym\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $reserve = Reserve::find($request->reserve_id);
        $price = $reserve->sens->priceGroup->price;
        $price = (int)Str::remove(',', $price);
        $cart = Cart::firstOrCreate([
            'service_id' => $reserve->sens->service_id,
            'user_id' => $request->user_id,
            'reserve_id' => $reserve->id,
            'sens_price' => $price,
        ]);
        $carts = Cart::where('user_id', $user->id)->get();

        return view('Reserve::Cart.cart', compact('carts', 'user'));
    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        $carts = Cart::where('user_id', $user->id)->get();
        $cart = view('Reserve::Cart.cart', compact('carts', 'user'))->render();
        return response()->json(compact('cart'));
    }

    public function destroy($id)
    {
        Cart::destroy($id);
        return response('ok');
    }
}
