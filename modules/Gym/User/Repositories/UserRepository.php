<?php

namespace Gym\User\Repositories;

use Gym\User\Models\User;
use Gym\User\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface
{
    /**
     * fetch query builder categories.
     * @return Builder
     */
    private function fetchQueryBuilder(): Builder
    {
        return User::query();
    }

    /**
     * paginate categories.
     * @param int $per_page
     * @return LengthAwarePaginator
     */
    public function paginate(int $per_page = 20): LengthAwarePaginator
    {
        return $this->fetchQueryBuilder()->paginate();
    }

    /**
     * returns all products.
     * @param string|null $status
     * @return LengthAwarePaginator
     */
    public function getAll(string $status = null): LengthAwarePaginator
    {
        $query = $this->fetchQueryBuilder();
        if ($status) $query->where("status", $status);
        return $query->latest()->paginate(20);
    }

    /**
     * find by id the record with the given id.
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getById(int $id): Model|Collection|Builder|array|null
    {
        return $this->fetchQueryBuilder()->findOrFail($id);
    }

    /**
     * @param $email
     * @return Builder|Model|null
     */
    public function findByEmail($email): Model|Builder|null
    {
        return $this->fetchQueryBuilder()->where('email', $email)->first();
    }

    /**
     * Update the specified resource in storage.
     * @param $user_id
     * @param $value
     * @return mixed
     */
    public function update($user_id, $value): mixed
    {
        $update = [
            'name' => $value->name,
            'username' => $value->username,
            'email' => $value->email,
            'mobile' => $value->mobile,
            'status' => $value->status,
            'role' => $value->role,
        ];
        if (!is_null($value->password)) {
            $update['password'] = bcrypt($value->password);
        }
        return User::where('id', $user_id)->update($update);
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        User::where('id', $id)->delete();
        try {
            $id->delete();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }
}