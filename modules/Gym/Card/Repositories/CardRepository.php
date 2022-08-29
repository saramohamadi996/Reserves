<?php

namespace Gym\Card\Repositories;

use Gym\Card\Models\Card;
use Gym\Card\Repositories\Interfaces\CardRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class CardRepository implements CardRepositoryInterface
{
    /**
     * fetch query builder categories.
     * @return Builder
     */
    private function fetchQueryBuilder(): Builder
    {
        return Card::query();
    }

    private function getCardQuery($id)
    {
        return $this->fetchQueryBuilder()->where('card_id', $id)
            ->where('is_enabled', '=', 1);
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
        if ($status) $query->where("is_enabled", $status);
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
     * @return bool
     */
    public function store($value): bool
    {
        $card = new Card();
        $card->user_id = auth()->id();
        $card->name_account_holder = $value['name_account_holder'];
        $card->bank_name = $value['bank_name'];
        $card->card_number = $value['card_number'];
        try {
            $card->save();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }

    /**
     * Update the specified resource in storage.
     * @param array $value
     * @param Card $card
     * @return bool
     */
    public function update(array $value, Card $card): bool
    {
        if (isset($value['user_id'])) {
            $card->user_id = auth()->id();
        }
        if (isset($value['is_enabled'])) {
            $card->is_enabled = $value['is_enabled'];
        }
        if (isset($value['name_account_holder'])) {
            $card->name_account_holder = $value['name_account_holder'];
        }
        if (isset($value['bank_name'])) {
            $card->bank_name = $value['bank_name'];
        }
        if (isset($value['card_number'])) {
            $card->card_number = $value['card_number'];
        }
        try {
            $card->save();
        } catch (QueryException $queryException) {
            Log::error($queryException->getMessage());
            return false;
        }
        return true;
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        Card::where('id', $id)->delete();
        try {
            $id->delete();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }
}
