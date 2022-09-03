<?php

namespace Gym\Service\Repositories\Interfaces;

use Gym\Service\Models\Service;
use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface
{
    /**
     * Get the value from the database.
     * @param $id
     * @param string|null $status
     * @return Collection
     */
    public function getAll($id,string $status = null): Collection;

    /**
     * @param $id
     * get service status.
     * @return Collection
     */
    public function getServiceStatus($id): Collection;

    public function getById($id);

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
