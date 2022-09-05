<?php

namespace Gym\Reserve\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface OrderRepositoryInterface
{
    /**
     * returns all orders.
     * @return Collection
     */
    public function getAll():Collection;

    /**
     * find by id the record with the given id.
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getById(int $id): Model|Collection|Builder|array|null;
}
