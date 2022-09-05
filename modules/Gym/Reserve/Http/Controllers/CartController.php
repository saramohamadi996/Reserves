<?php

namespace Gym\Reserve\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Reserve\Models\Cart;
use Gym\Reserve\Repositories\Interfaces\CartRepositoryInterface;
use Gym\Reserve\Repositories\Interfaces\ProductRepositoryInterface;
use Gym\User\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * The cart repository instance.
     */
    protected ProductRepositoryInterface $product_repository;
    protected UserRepositoryInterface $user_repository;
    protected CartRepositoryInterface $cart_repository;

    /**
     * Instantiate a new cart instance.
     * @param CartRepositoryInterface $cart_repository
     * @param ProductRepositoryInterface $product_repository
     * @param UserRepositoryInterface $user_repository
     */
    public function __construct(CartRepositoryInterface $cart_repository,
                                ProductRepositoryInterface $product_repository,
                                UserRepositoryInterface  $user_repository)
    {
        $this->cart_repository = $cart_repository;
        $this->product_repository = $product_repository;
        $this->user_repository = $user_repository;
    }

    /**
     * Display a listing of the resource.
     * @param $user_id
     * @return JsonResponse
     */
    public function show($user_id): JsonResponse
    {
        $user = $this->user_repository->getById($user_id);
        $carts = Cart::where('user_id', $user->id)->get();
        $cart = view('Reserve::Cart.cart', compact('carts', 'user'))->render();
        return response()->json(compact('cart'));
    }

    /**
     * Store a newly first or create resource in storage.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function cart(Request $request): View|Factory|Application
    {
        $id = $request->user_id;
        $reserve_id = $request->reserve_id;
        $user = $this->user_repository->getById($id);
        $reserve = $this->product_repository->getById($reserve_id);

        $price = $reserve->sens->priceGroup->price;
        $price = (int)Str::remove(',', $price);

        Cart::firstOrCreate([
            'service_id' => $reserve->sens->service_id,
            'user_id' => $request->user_id,
            'reserve_id' => $reserve->id,
            'sens_price' => $price,
        ]);
        $carts = Cart::where('user_id', $user->id)->get();
        return view('Reserve::Cart.cart', compact('carts', 'user'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Application|Response|ResponseFactory
     */
    public function destroy(int $id): Application|ResponseFactory|Response
    {
        $cart = $this->cart_repository->getById($id);
        $cart = $this->cart_repository->delete($cart);
        if (!$cart) {
            return response('error');
        }
        return response('ok');
    }
}
