<?php

namespace Gym\Reserve\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{
    /**
     * returns all orders.
     * @return Collection
     */
    public function getAll():Collection;
}
