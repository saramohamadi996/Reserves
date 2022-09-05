<?php

namespace Gym\Reserve\Repositories;

use Gym\Reserve\Models\Order;
use Gym\Reserve\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * fetch query builder orders.
     * @return Builder
     */
    private function fetchQueryBuilder(): Builder
    {
        return Order::query();
    }

    /**
     * returns all orders.
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
}
