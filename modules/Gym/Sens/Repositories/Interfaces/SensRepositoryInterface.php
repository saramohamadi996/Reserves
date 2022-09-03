<?php

namespace Gym\Sens\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface SensRepositoryInterface
{
    /**
     * Get the value from the database.
     * @param $id
     * @param string|null $status
     * @return Collection
     */
    public function getAll($id,string $status = null): Collection;

    /**
     * get card status.
     * @param $id
     * @return Collection
     */
    public function getSensStatus($id): Collection;

    /**
     * find by id the record with the given id.
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getById(int $id): Model|Collection|Builder|array|null;

    /**
     * Store a newly created resource in storage.
     * @param $product_id
     * @param $value
     * @return bool
     */
    public function store($product_id, $value): bool;

}
