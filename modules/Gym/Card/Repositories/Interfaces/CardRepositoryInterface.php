<?php

namespace Gym\Card\Repositories\Interfaces;

use Gym\Card\Models\Card;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CardRepositoryInterface
{
    /**
     * Get the value from the database.
     * @param string|null $status
     * @return Collection
     */
    public function getAll(string $status = null): Collection;

    /**
     * @param $id
     * get card status.
     * @return Collection
     */
    public function getCardStatus($id): Collection;

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
     * @param Card $card
     * @return bool
     */
    public function update(array $value, Card $card): bool;

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return bool
     */
    public function delete($id): bool;
}
