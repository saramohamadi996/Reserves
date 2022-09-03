<?php

namespace Gym\Card\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Card\Http\Requests\CardRequestStore;
use Gym\Card\Http\Requests\CardRequestUpdate;
use Gym\Card\Repositories\Interfaces\CardRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CardController extends Controller
{
    /**
     * The card repository instance.
     * @var CardRepositoryInterface
     */
    protected CardRepositoryInterface $card_repository;

    /**
     * Instantiate a new card instance.
     * @param CardRepositoryInterface $card_repository
     */
    public function __construct(CardRepositoryInterface $card_repository)
    {
        $this->card_repository = $card_repository;
    }

    /**
     * Display a listing of the resource.
     * @param $id
     * @param string|null $status
     * @return Application|Factory|View
     */
    public function index($id, string $status = null): View|Factory|Application
    {
        $cards = $this->card_repository->getAll($id);
        return view('Cards::Cards.index', compact('cards'));
    }

    /**
     * create the form for creating a new resource.
     * @return Application|Factory|View
     */
    public function create($id, string $status = null): View|Factory|Application
    {
        $cards = $this->card_repository->getAll($id);
        return view('Cards::Cards.create', compact('cards'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CardRequestStore $request
     * @return RedirectResponse
     */
    public function store(CardRequestStore $request): RedirectResponse
    {
        $input = $request->only(['user_id','name_account_holder','bank_name', 'card_number']);
        $cards = $this->card_repository->store($input);
        if (!$cards) {
            return redirect()->back()->with('error', 'عملیات ذخیره سازی با شکست مواجه شد.');
        }
        return redirect()->route('cards.index')->with('success', 'عملیات ذخیره سازی با موفقیت انجام شد.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $card_id
     * @param $id
     * @param string|null $status
     * @return Application|Factory|View
     */
    public function edit(int $card_id, $id, string $status = null): View|Factory|Application
    {
        $card = $this->card_repository->getById($card_id);
        $cards = $this->card_repository->getAll($id);
        return view('Cards::Cards.edit', compact('card', 'cards'));
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @param CardRequestUpdate $request
     * @return RedirectResponse
     */
    public function update(int $id, CardRequestUpdate $request): RedirectResponse
    {
        $card = $this->card_repository->getById($id);
        $input = $request->only(['user_id','name_account_holder','bank_name', 'card_number','status']);
        $result = $this->card_repository->update($input, $card);
        if (!$result) {
            return redirect()->back()->with('error', 'عملیات بروزرسانی با شکست مواجه شد.');
        }
        return redirect()->route('cards.index')->with('success', 'عملیات بروزرسانی با موفقیت انجام شد.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $card = $this->card_repository->getById($id);
        $card = $this->card_repository->delete($card);
        if (!$card) {
            return redirect()->back()->with('error', 'عملیات حذف با شکست مواجه شد.');
        }
        return redirect()->back()->with('success', 'عملیات حذف با موفقیت شد.');
    }

    /**
     * status card
     * @param int $id
     * @return RedirectResponse
     */
    public function toggle(int $id): RedirectResponse
    {
        $card = $this->card_repository->getById($id);
        $input = ['status' => !$card->status];
        $result = $this->card_repository->update($input, $card);
        if (!$result) {
            return redirect()->back()->with('error', 'فعالسازی با مشکل مواجه شد');
        }
        return redirect()->back()->with('success', 'فعال شد');
    }

}
