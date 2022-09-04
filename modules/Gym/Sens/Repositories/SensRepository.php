<?php

namespace Gym\Sens\Repositories;

use Carbon\Carbon;
use Gym\Sens\Models\Sens;
use Gym\Sens\Repositories\Interfaces\SensRepositoryInterface;
use Gym\Service\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class SensRepository implements SensRepositoryInterface
{
    /**
     * fetch query builder categories.
     * @return Builder
     */
    private function fetchQueryBuilder(): Builder
    {
        return Sens::query();
    }

    /**
     * Get the value from the database.
     * @param string|null $status
     * @return Collection
     */
    public function getAll(string $status = null): Collection
    {
        $query = $this->fetchQueryBuilder();
        if ($status) $query->where("status", $status);
        return $query->latest()->get();
    }

    /**
     * get card status.
     * @param $id
     * @return Collection
     */
    public function getSensStatus($id): Collection
    {
        return $this->getAll($id)->where('sens_id', $id)
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
     * @param $service_id
     * @param $value
     * @return bool
     */
    public function store($service_id, $value):bool
    {
        $sens = new Sens();
        $sens->user_id = auth()->id();
        $sens->start = $value['start'];
        $sens->end = $value['end'];
        $sens->volume = $value['volume'];
        $sens->start_at = $value['start_at'];
        $sens->expire_at = $value['expire_at'];
        $sens->service_id = $service_id->id;
        $sens->price_group_id = $value['price_group_id'];
        $sens->day = $value['day'];
        try {
            $sens->save();
            $this->createReserves($sens);
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }

    private function createReserves(Sens $sens)
    {
        $start_at = Carbon::parse($sens->start_at);
        $expire_at = Carbon::parse($sens->expire_at);
        $start = Carbon::parse($sens->start);
        for ($date = $start_at; $date->lte($expire_at); $date->addDay()) {
            if (in_array($date->dayOfWeek, $sens->toArray()['day'])) {
                $start_datetime = $date->copy()->addHours($start->hour)->addMinutes($start->minute);
                $sens->reserves()->create([
                    'start_time' => $start_datetime
                ]);
            }
        }
        return true;
    }

    /**
     * Update the specified resource in storage.
     * @param array $value
     * @param Sens $sens
     * @return bool
     */
    public function update(array $value, Sens $sens): bool
    {
        if (isset($value['status'])) {
            $sens->status = $value['status'];
        }
        if (isset($value['price_group_id'])) {
            $sens->price_group_id = $value['price_group_id'];
        }
        try {
            $sens->save();
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
        Sens::where('id', $id)->delete();
        try {
            $id->delete();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return false;
        }
        return true;
    }

}
