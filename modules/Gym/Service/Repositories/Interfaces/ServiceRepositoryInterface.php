<?php

namespace Gym\Service\Repositories\Interfaces;

use Gym\Service\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ServiceRepositoryInterface
{
    /**
     * returns all price groups.
     * @param string|null $status
     * @return Collection
     */
    public function getAll(string $status = null):Collection;

    /**
     * @param $id
     * get service status.
     * @return Collection
     */
    public function getServiceStatus($id): Collection;

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
     * @param Service $service
     * @return bool
     */
    public function update(array $value, Service $service): bool;

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return bool
     */
    public function delete($id): bool;
}
