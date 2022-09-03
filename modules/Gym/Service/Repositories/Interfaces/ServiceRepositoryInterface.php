<?php

namespace Gym\Service\Repositories\Interfaces;

use Gym\Service\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface
{
    /**
     * paginate services.
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator;

    /**
     * Get the value from the database.
     * @return Collection
     */
    public function getAll(): Collection;

    public function getById( $id);

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
