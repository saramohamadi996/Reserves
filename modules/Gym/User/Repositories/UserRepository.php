<?php

namespace Gym\User\Repositories;

use Gym\User\Models\User;
use Gym\User\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface
{
    /**
     * fetch query builder users.
     * @param array $input
     * @return Builder
     */
    private function fetchQueryBuilder(array $input = []): Builder
    {
        return User::query()
        ->when(isset($input['mobile']), function (Builder $query) use ($input) {
        $query->where('mobile', 'like', '%' . $input['mobile'] . '%');
    })
        ->when(isset($input['name']), function (Builder $query) use ($input) {
        $query->where('name', 'like', '%' . $input['name'] . '%');
    });
    }

    /**
     * paginate products.
     * @param array $input
     * @param int $per_page
     * @return LengthAwarePaginator
     */
    public function paginate(array $input = [], int $per_page = 10): LengthAwarePaginator
    {
        return $this->fetchQueryBuilder($input)->paginate($per_page);
    }

    /**
     * returns all users.
     * @param string|null $status
     * @return LengthAwarePaginator
     */
    public function getAll(string $status = null): LengthAwarePaginator
    {
        $query = $this->fetchQueryBuilder();
        if ($status) $query->where("status", $status);
        return $query->latest()->paginate(10);
    }

    /**
     * get user status.
     * @param $id
     * @return LengthAwarePaginator
     */
    public function getUserStatus($id): LengthAwarePaginator
    {
        return $this->getAll($id)->where('user_id', $id)
            ->where('status', '=', 'active');
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
     * Update the specified resource in storage.
     * @param array $value
     * @param User $user
     * @return bool
     */
    public function update(array $value, User $user): bool
    {
        if (isset($value['status'])) {
            $user->status = $value['status'];
        }
        if (isset($value['name'])) {
            $user->name = $value['name'];
        }
        if (isset($value['username'])) {
            $user->username = $value['username'];
        }
        if (isset($value['email'])) {
            $user->email = $value['email'];
        }
        if (isset($value['mobile'])) {
            $user->mobile = $value['mobile'];
        }
        if (isset($value['role'])) {
            $user->role = $value['role'];
        }
        if (!is_null($value['password'])) {
            $user->password = bcrypt($value['password']);
        }
        try {
            $user->save();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
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
