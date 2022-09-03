<?php

namespace Gym\PriceGroup\Repositories;

use Gym\PriceGroup\Models\PriceGroup;
use Gym\PriceGroup\Repositories\Interfaces\PriceGroupRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class PriceGroupRepository implements PriceGroupRepositoryInterface
{
    /**
     * fetch query builder categories.
     * @return Builder
     */
    private function fetchQueryBuilder(): Builder
    {
        return PriceGroup::query();
    }

    private function getPriceGroupQuery($id): Builder
    {
        return $this->fetchQueryBuilder()->where('price_group_id', $id)
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
        $price_group = new PriceGroup();
        $price_group->user_id = auth()->id();
        $price_group->title = $value['title'];
        $price_group->price = $value['price'];
        $price_group->category_id = $value['category_id'];
        try {
            $price_group->save();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }

    /**
     * Update the specified resource in storage.
     * @param array $value
     * @param PriceGroup $price_group
     * @return bool
     */
    public function update(array $value, PriceGroup $price_group): bool
    {
        if (isset($value['user_id'])) {
            $price_group->user_id = auth()->id();
        }
        if (isset($value['is_enabled'])) {
            $price_group->is_enabled = $value['is_enabled'];
        }
        if (isset($value['title'])) {
            $price_group->title = $value['title'];
        }
        if (isset($value['price'])) {
            $price_group->price = $value['price'];
        }
        if (isset($value['category_id'])) {
            $price_group->category_id = $value['category_id'];
        }
        try {
            $price_group->save();
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
        PriceGroup::where('id', $id)->delete();
        try {
            $id->delete();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }
}
