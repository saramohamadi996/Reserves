<?php

namespace Gym\Reserve\Repositories;

use Gym\Reserve\Models\Cart;
use Gym\Reserve\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class CartRepository implements CartRepositoryInterface
{
    /**
     * fetch query builder carts.
     * @return Builder
     */
    private function fetchQueryBuilder(): Builder
    {
        return Cart::query();
    }

    /**
     * returns all carts.
     * @return Collection
     */
    public function getAll():Collection
    {
        $query =$this->fetchQueryBuilder();
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
     * Remove the specified resource from storage.
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        Cart::where('id', $id)->delete();
        try {
            $id->delete();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }
}
