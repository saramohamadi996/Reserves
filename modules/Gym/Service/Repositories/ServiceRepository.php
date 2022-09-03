<?php

namespace Gym\Service\Repositories;

use Gym\Service\Models\Service;
use Gym\Service\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * fetch query builder services.
     * @return Builder
     */
    private function fetchQueryBuilder(): Builder
    {
        return Service::query();
    }

    /**
     * paginate services.
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return $this->fetchQueryBuilder()->paginate();
    }

    /**
     * Get the value from the database.
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->fetchQueryBuilder()->latest()->get();
    }

    public function getById($id)
    {
        return $this->fetchQueryBuilder()->findOrFail($id);
    }

    public function findById($id)
    {
        return Service::findOrFail($id);
    }

    public function store($value): bool
    {
        $service = new Service();
        $service->user_id = auth()->id();
        $service->price_group_id = $value['price_group_id'];
        $service->category_id = $value['category_id'];
        $service->body = $value['body'];
        $service->title = $value['title'];
        $service->slug = $value['slug'];
        $service->priority = $value['priority'];
        $service->code_service = $value['code_service'];
        try {
            if ($service->save()) {
                $days = $value['days'];
                $service->day()->sync($days);
            }
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }

    /**
     * Update the specified resource in storage.
     * @param array $value
     * @param Service $service
     * @return bool
     */
    public function update(array $value, Service $service): bool
    {
        if (isset($value['is_enabled'])) {
            $service->is_enabled = $value['is_enabled'];
        }
        if (isset($value['title'])) {
            $service->title = $value['title'];
        }
        if (isset($value['slug'])) {
            $service->slug = $value['slug'];
        }
        if (isset($value['code_service'])) {
            $service->code_service = $value['code_service'];
        }
        if (isset($value['priority'])) {
            $service->priority = $value['priority'];
        }
        if (isset($value['category_id'])) {
            $service->category_id = $value['category_id'];
        }
        try {
            $service->save();
        } catch (QueryException $queryException) {
            Log::error($queryException->getMessage());
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
        Service::where('id', $id)->delete();
        try {
            $id->delete();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }
}
