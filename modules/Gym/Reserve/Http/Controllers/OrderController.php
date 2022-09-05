<?php

namespace Gym\Reserve\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Card\Repositories\Interfaces\CardRepositoryInterface;
use Gym\Reserve\Models\Cart;
use Gym\Reserve\Models\Order;
use Gym\Reserve\Repositories\Interfaces\OrderRepositoryInterface;
use Gym\User\Models\User;
use Gym\User\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * The card repository instance.
     * @var CardRepositoryInterface
     */
    protected CardRepositoryInterface $card_repository;
    protected OrderRepositoryInterface $order_repository;
    protected UserRepositoryInterface $user_repository;

    /**
     * Instantiate a new card instance.
     * @param CardRepositoryInterface $card_repository
     * @param OrderRepositoryInterface $order_repository
     * @param UserRepositoryInterface $user_repository
     */
    public function __construct(CardRepositoryInterface  $card_repository,
                                OrderRepositoryInterface $order_repository,
                                UserRepositoryInterface  $user_repository)
    {
        $this->card_repository = $card_repository;
        $this->order_repository = $order_repository;
        $this->user_repository = $user_repository;
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('Reserve::Order.order');
    }

    /**
     * Display a listing of the resource.
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): View|Factory|Application
    {
        $user = $this->user_repository->getById($id);
        $carts = Cart::where('user_id', $user->id)->get();
        $orders = Order::with('reserve.sens')->where([['user_id', $user->id], ['status', 'pending']])->get();
        return view('Reserve::Order.order', compact('user', 'carts', 'orders'));
    }

    /**
     * Store a newly created or updated resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $id = $request->user;
        $user = $this->user_repository->getById($id);
        $carts = Cart::where('user_id', $user->id)->get();
        foreach ($carts as $cart) {
            Order::query()->updateOrCreate([
                'service_id' => $cart->service_id,
                'user_id' => $cart->user_id,
                'reserve_id' => $cart->reserve_id,
            ], [
                'start_time' => $cart->reserve->start_time,
                'end_time' => $cart->reserve->end_time,
                'price' => $cart->sens_price,
                'status' => 'pending'
            ]);
        }
        return redirect()->action([OrderController::class, 'show'], ['user' => $user]);
    }

    /**
     * Deducting the order amount from the wallet and final registration of the order.
     * @param Request $request
     * @return RedirectResponse|string
     */
    public function wallet(Request $request): string|RedirectResponse
    {
        $id = $request->user;
        $user = $this->user_repository->getById($id);
        $orders = Order::where([['user_id', $user->id], ['status', 'pending']])->get();
        if ($orders->sum('price') > $user->balance) {
            return 'موجودی کافی نیست';
        } else {
            $user->transactions()->create([
                'card_id' => 0,
                'admin_id' => auth()->id(),
                'type' => 'debit',
                'amount' => $orders->sum('price'),
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
        return redirect()->action([OrderController::class, 'detail'], ['user' => $user]);
    }

    /**
     * Display the order details of the selected user.
     * @param User $user
     * @return Application|Factory|View
     */
    public function detail(User $user): View|Factory|Application
    {
        return view('Reserve::Order.order-detail', compact('user'));
    }

    /**
     * order canceled.
     * @param Request $request
     * @param $order_id
     * @return Application|Factory|View
     */
    public function cancel(Request $request,$order_id): View|Factory|Application
    {
        $id = $request->user;
        $order = $this->order_repository->getById($order_id);
        $user = $this->user_repository->getById($id);
        $price = $order->price;
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
