<?php

namespace Gym\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Card\Models\Card;
use Gym\Card\Repositories\Interfaces\CardRepositoryInterface;
use Gym\User\Http\Requests\WalletUpdateRequest;
use Gym\User\Models\User;
use Gym\User\Repositories\Interfaces\UserRepositoryInterface;
use Gym\User\Repositories\Interfaces\WalletRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    /**
     * The wallet repository instance.
     * @var WalletRepositoryInterface
     * @var UserRepositoryInterface
     */
    protected WalletRepositoryInterface $wallet_repository;
    protected UserRepositoryInterface $user_repository;
    protected CardRepositoryInterface $card_repository;

    /**
     * Instantiate a new wallet instance.
     * @param WalletRepositoryInterface $wallet_repository
     * @param UserRepositoryInterface $user_repository
     * @param CardRepositoryInterface $card_repository
     */
    public function __construct(WalletRepositoryInterface $wallet_repository,
                                UserRepositoryInterface   $user_repository,
                                CardRepositoryInterface $card_repository)
    {
        $this->wallet_repository = $wallet_repository;
        $this->user_repository = $user_repository;
        $this->card_repository = $card_repository;
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $wallets = $this->wallet_repository->getAll();
        return view('User::Wallet.index', compact('wallets'));
    }

    /**
     * @param int $id
     * @param $card_id
     * @param string|null $status
     * @return Application|Factory|View
     */
    public function create(int $id,$card_id, string $status = null): View|Factory|Application
    {
        $user = $this->user_repository->getById($id);
        $cards = $this->card_repository->getCardStatus($card_id);
        return view('User::Wallet.create', compact( 'user', 'cards'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param int $user_id
     * @return RedirectResponse
     */
    public function store(Request $request, int $user_id): RedirectResponse
    {
        $user = $this->user_repository->getById($user_id);
        $input = $request->only(
            'admin_id', 'user_id', 'card_id', 'type', 'amount', 'description', 'date_payment', 'status'
        );
        $wallets = $this->wallet_repository->store($input,$user);
        if (!$wallets) {
            return redirect()->back()->with('error', 'عملیات ذخیره سازی با شکست مواجه شد.');
        }
        return redirect()->route('users.index', )->with('success', 'عملیات ذخیره سازی با موفقیت انجام شد.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $wallet_id
     * @param $id
     * @param string|null $status
     * @return Application|Factory|View
     */
    public function edit(int $wallet_id, $id, string $status = null): View|Factory|Application
    {
        $cards = $this->card_repository->getCardStatus($id);
        $user = $this->user_repository->getAll();
        $wallet = $this->wallet_repository->getById($wallet_id);
        return view('User::Wallet.edit', compact('wallet','cards', 'user'));
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @param WalletUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        $wallet = $this->wallet_repository->getById($id);
        $input = $request->only(['user_id', 'type', 'amount', 'description', 'status', 'date_payment']);
        $result = $this->wallet_repository->update($input, $wallet);
        if (!$result) {
            return redirect()->back()->with('error', 'عملیات بروزرسانی با شکست مواجه شد.');
        }
        return redirect()->route('wallets.index')->with('success', 'عملیات بروزرسانی با موفقیت انجام شد.');
    }

    /**
     * enable banner
     * @param int $id
     * @return RedirectResponse
     */
    public function toggle(int $id): RedirectResponse
    {
        $wallet = $this->wallet_repository->getById($id);
        $input = ['status' => !$wallet->status];
        $result = $this->wallet_repository->update($input, $wallet);
        if (!$result) {
            return redirect()->back()->with('error', 'فعالسازی با مشکل مواجه شد');
        }
        return redirect()->back()->with('success', 'فعال شد');
    }

}
