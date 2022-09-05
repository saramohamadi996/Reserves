<?php

namespace Gym\Reserve\Repositories;

use Gym\Reserve\Models\Cart;
use Gym\Reserve\Models\Reserve;
use Gym\Reserve\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CartRepository implements CartRepositoryInterface
{
    public function cart($value, Reserve $reserve)
    {
        $price = $reserve->sens->priceGroup->price;
        $price = (int)Str::remove(',', $price);
        $cart = Cart::firstOrCreate([
            'service_id' => $reserve->sens->service_id,
            'user_id' => $value->user_id,
            'reserve_id' => $reserve->id,
            'sens_price' => $price,
        ]);
        dd($cart);
        try {
            $cart->save();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($id)
    {
        Cart::destroy($id);
        return response('ok');
    }
}
