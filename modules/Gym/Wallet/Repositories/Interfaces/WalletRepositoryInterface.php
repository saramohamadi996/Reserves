<?php

namespace Gym\Wallet\Repositories\Interfaces;

use Gym\User\Models\User;
use Gym\Wallet\Models\Wallet;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface WalletRepositoryInterface
{
    /**
     * paginate percents.
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator;

    /**
     * returns all products.
     * @param string|null $status
     * @return Collection
     */
    public function getAll(string $status = null):Collection;

    /**
     * find by id the record with the given id.
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getById(int $id): Model|Collection|Builder|array|null;

    /**
     * Store a newly created resource in storage.
     * @param $value
     * @param User $user_id
     * @return bool
     */
    public function store($value, User $user): bool;

    /**
     * Update the specified resource in storage.
     * @param array $value
     * @param Wallet $percent
     * @return bool
     */
    public function update(array $value, Wallet $percent): bool;

}
