<?php

namespace Gym\Wallet\Repositories;

use Gym\User\Models\User;
use Gym\Wallet\Models\Wallet;
use Gym\Wallet\Repositories\Interfaces\WalletRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class WalletRepository implements WalletRepositoryInterface
{
    /**
     * fetch query builder categories.
     * @return Builder
     */
    private function fetchQueryBuilder(): Builder
    {
        return Wallet::query();
    }

    private function getPriceGroupQuery($id)
    {
        return $this->fetchQueryBuilder()->where('wallet_id', $id)
            ->where('status', '=', 1);
    }

    /**
     * paginate categories.
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return $this->fetchQueryBuilder()->paginate();
    }

    /**
     * returns all products.
     * @param string|null $status
     * @return Collection
     */
    public function getAll(string $status = null):Collection
    {
        $query = $this->fetchQueryBuilder();
        if ($status) $query->where("status", $status);
        return $query->latest()->get();
    }

    /**
     * find by id the record with the given id.
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getById(int $id): Model|Collection|Builder|array|null
    {
        return $this->fetchQueryBuilder()->findOrFail($id);
    }

    /**
     * Store a newly created resource in storage.
     * @param $value
     * @param User $user_id
     * @return bool
     */
    public function store($value, User $user): bool
    {
        $wallet = new Wallet();
        $wallet->admin_id = auth()->id();
        $wallet->user_id = $user->id;
        $wallet->card_id = $value['card_id'];
        $wallet->type = 'credit';
        $wallet->amount = $value['amount'];
        $wallet->description = $value['description'];
        $wallet->date_payment = $value['date_payment'];
        $wallet->save();
        try {
            $wallet->save();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }

    /**
     * Update the specified resource in storage.
     * @param array $value
     * @param Wallet $wallet
     * @return bool
     */
    public function update(array $value, Wallet $wallet): bool
    {

        if (isset($value['admin_id'])) {
            $wallet->admin_id = auth()->id();
        }
        if (isset($value['user_id'])) {
            $wallet->user_id = $value['user_id'];
        }
        if (isset($value['status'])) {
            $wallet->status = $value['status'];
        }
        if (isset($value['type'])) {
            $wallet->type = $value['type'];
        }
        if (isset($value['amount'])) {
            $wallet->amount = $value['amount'];
        }
        if (isset($value['description'])) {
            $wallet->description = $value['description'];
        }
        if (isset($value['status'])) {
            $wallet->status = $value['status'];
        }
        try {
            $wallet->save();
        } catch (QueryException $queryException) {
            Log::error($queryException->getMessage());
            return false;
        }
        return true;
    }

}
