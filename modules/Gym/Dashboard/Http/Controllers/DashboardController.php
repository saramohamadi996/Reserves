<?php

namespace Gym\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gym\Card\Models\Card;
use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Gym\User\Models\Wallet;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Filter by time period.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $staffs = User::query()
            ->where('role', 'admin')
            ->orWhere('role', 'staff')
            ->latest()->get()
            ->loadCount(['registered_users' => function ($q) use ($end, $start) {
                return
                    $q->whereDate('created_at', ">=", $start)
                        ->whereDate('created_at', "<=", $end);
            }]);

        $cards = Card::query()
            ->withSum(['wallets' => function ($q) use ($end, $start) {
                $q->whereDate('date_payment', ">=", $start);
                $q->whereDate('date_payment', "<=", $end);
                $q->where('type', 'credit');
            }], 'amount')->latest()->get();

        $credits = Wallet::query()
            ->where('type', 'credit')
            ->whereDate('date_payment', ">=", $start)
            ->whereDate('date_payment', "<=", $end)
            ->sum('amount');


        $debits = Wallet::query()
            ->where('type', 'debit')
            ->whereDate('date_payment', ">=", $start)
            ->whereDate('date_payment', "<=", $end)
            ->sum('amount');

        $services = Service::query()
            ->withCount(['orders' => function ($q) use ($end, $start) {
                $q->where('status', 'paid');
                $q->whereDate('created_at', ">=", $start);
                $q->whereDate('created_at', "<=", $end);
            }])
            ->withSum(['paid_orders' => function ($q) use ($end, $start) {
                $q->whereDate('created_at', ">=", $start);
                $q->whereDate('created_at', "<=", $end);
            }], 'price')->latest()->get();

        if ($request->ajax())
            return view('Dashboard::Statistics.all', compact('cards', 'credits', 'debits', 'staffs', 'services'));

        return view('Dashboard::Statistics.index', compact('cards', 'credits', 'debits', 'staffs', 'services'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return string
     */
    public function staffRegisteredUsersDetail(Request $request, User $user): string
    {
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $registered_users = $user->registered_users()
            ->whereDate('created_at', ">=", $start)
            ->whereDate('created_at', "<=", $end)
            ->get();

        return view('Dashboard::Statistics.staffs-details', compact('registered_users'))->render();
    }

    /**
     * Display details of bank deposits.
     * @param Request $request
     * @param Card $card
     * @return string
     */
    public function cardDetail(Request $request, Card $card): string
    {
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $wallets = $card->wallets()
            ->whereDate('date_payment', ">=", $start)
            ->whereDate('date_payment', "<=", $end)
            ->where('type', 'credit')
            ->with('user')
            ->get();

        return view('Dashboard::Statistics.card-details', compact('wallets'))->render();
    }

    /**
     * Display details of users' wallet transactions.
     * @param Request $request
     * @return string
     */
    public function walletDetail(Request $request): string
    {
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $wallets = Wallet::query()
            ->where('type', $request->type)
            ->whereDate('date_payment', ">=", $start)
            ->whereDate('date_payment', "<=", $end)
            ->latest('date_payment')
            ->get()
            ->load('user');
        return view('Dashboard::Statistics.card-details', compact('wallets'))->render();
    }

    /**
     * Show details of services.
     * @param Request $request
     * @param Service $service
     * @return string
     */
    public function service_detail(Request $request, Service $service): string
    {
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $orders = $service->paid_orders()
            ->whereDate('created_at', ">=", $start)
            ->whereDate('created_at', "<=", $end)
            ->with('user')
            ->get();
        return view('Dashboard::Statistics.services-details',
            compact('orders', 'service'))->render();
    }
}
