<?php

namespace Gym\PriceGroup\Repositories\Interfaces;

use Gym\PriceGroup\Models\PriceGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface PriceGroupRepositoryInterface
{
    /**
     * returns all price groups.
     * @param $id
     * @param string|null $status
     * @return Collection
     */
    public function getAll($id, string $status = null):Collection;

    /**
     * @param $id
     * get price group status.
     * @return Collection
     */
    public function getPriceGroupStatus($id): Collection;

    /**
     * find by id the record with the given id.
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getById(int $id): Model|Collection|Builder|array|null;

    /**
     * Store a newly created resource in storage.
     * @param $value
     * @return bool
     */
    public function store($value): bool;

    /**
     * Update the specified resource in storage.
     * @param array $value
     * @param PriceGroup $price_group
     * @return bool
     */
    public function update(array $value, PriceGroup $price_group): bool;

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return bool
     */
    public function delete($id): bool;
}
