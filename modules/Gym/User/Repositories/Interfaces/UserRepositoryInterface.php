<?php

namespace Gym\User\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    /**
     * returns all products.
     * @param $id
     * @param string|null $status
     * @return LengthAwarePaginator
     */
    public function getAll($id, string $status = null): LengthAwarePaginator;

    /**
     * @param $id
     * get user status.
     * @return LengthAwarePaginator
     */
    public function getUserStatus($id): LengthAwarePaginator;

    /**
     * find by id the record with the given id.
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getById(int $id): Model|Collection|Builder|array|null;

    /**
     * Update the specified resource in storage.
     * @param $user_id
     * @param $value
     * @return mixed
     */
    public function update($user_id, $value): mixed;

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return bool
     */
    public function delete($id): bool;
}
