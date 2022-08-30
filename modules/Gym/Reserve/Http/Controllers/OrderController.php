<?php

namespace Gym\Reserve\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Reserve\Models\Cart;
use Gym\Reserve\Models\Order;
use Gym\User\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('Reserve::Order.order');
    }

    public function store(Request $request)
    {
        $user = User::findOrFail($request->user);
        $carts = Cart::where('user_id', $user->id)->get();
        foreach ($carts as $cart) {
            Order::firstOrCreate([
                'service_id' => $cart->service_id,
                'user_id' => $cart->user_id,
                'reserve_id' => $cart->reserve_id,
                'price' => $cart->sens_price,
                'status' => 'pending'
            ]);
        }
        return redirect()->action([OrderController::class,'show'], ['user' => $user]);
    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        $carts = Cart::where('user_id', $user->id)->get();
        $orders =  Order::with('reserve.sens')->where([['user_id', $user->id],['status','pending']])->get();
        return view('Reserve::Order.order', compact( 'user', 'carts', 'orders'));
    }

    public function wallet(Request $request)
    {
        $user = User::findOrFail($request->user);
        $orders =  Order::with('reserve.sens.priceGroup')->where([['user_id', $user->id],['status','pending']])->get();
        if ($orders->sum('reserve.sens.priceGroup.price') > $user->balance){
            return 'موجودی کافی نیست';
        }else {
            $user->transactions()->create([
                'card_id' => 0,
                'admin_id' => auth()->id(),
                'type' => 'debit',
                'amount' => $orders->sum('reserve.sens.priceGroup.price'),
                'date_payment' => now()->toDateString()
            ]);
            $orders->each(function (Order $order) {
                $sens = $order->reserve->sens;
                $reserve = $order->reserve;
                if ($reserve->users->count() >= $sens->volume) return 'sens full';
                $order->update(['status' => 'paid']);
            });
            $user->carts()->delete();
        }
        return redirect()->action([OrderController::class,'detail'], ['user' => $user]);
    }

    public function detail(User $user)
    {
        return view('Reserve::Order.order-detail', compact('user'));
    }

    public function cancel(Request $request,$id)
    {
        $order = Order::findOrFail($id);
        $price = $order->reserve->sens->priceGroup->price;
        $user = User::find($request->user);
        $user->transactions()->create([
            'card_id' => 0,
            'admin_id' => auth()->id(),
            'type' => 'credit',
            'amount' => $price,
            'date_payment' => now()->toDateString()
        ]);
        $order->update(['status' => 'canceled']);
        return view('Reserve::Order.order-table', compact('user'));
    }
}
