<?php

namespace Gym\Category\Repositories;

use Gym\Category\Models\Category;
use Gym\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * fetch query builder categories.
     * @return Builder
     */
    private function fetchQueryBuilder(): Builder
    {
        return Category::query();
    }

    /**
     * Get the value from the database.
     * @param string|null $status
     * @return Collection
     */
    public function getAll(string $status = null):Collection
    {
        $query = $this->fetchQueryBuilder();
        if ($status) $query->where("status", $status);
        return $query->latest()->get();
    }

    /** get category status.
     * @param $id
     * @return Collection
     */
    public function getCategoryStatus($id): Collection
    {
        return $this->getAll($id)->where('category_id', $id)
            ->where('status', '=', 1);
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
     * Store a newly created resource in storage.
     * @param $value
     * @return bool
     */
    public function store($value): bool
    {
        $category = new Category();
        $category->title = $value['title'];
        $category->parent_id = $value['parent_id'];
        try {
            $category->save();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }

    /**
     * Update the specified resource in storage.
     * @param array $value
     * @param Category $category
     * @return bool
     */
    public function update(array $value, Category $category): bool
    {
        if (isset($value['status'])) {
            $category->status = $value['status'];
        }
        if (isset($value['title'])) {
            $category->title = $value['title'];
        }
        if (isset($value['slug'])) {
            $category->slug = $value['slug'];
        }
        if (isset($value['parent_id'])) {
            $category->parent_id = $value['parent_id'];
        }
        try {
            $category->save();
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
        Category::where('id', $id)->delete();

        try {
            $id->delete();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }
}
