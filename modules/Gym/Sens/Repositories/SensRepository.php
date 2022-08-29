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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Morilog\Jalali\Jalalian;

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
     * @return void
     */
    public function getAll()
    {
        $this->fetchQueryBuilder()->latest()->get();
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
    public function store($service_id, $value)
    {
        Service::where('id', $service_id)->first();
        $sens = Sens::query()->create([
                'start_at' => $value['start_at'],
                'expire_at' => $value['expire_at'],
                'service_id' => $service_id,
                'user_id' => auth()->id(),
                'price_group_id' => $value['price_group_id'],
            ] + $value->all());
        $this->createReserves($sens);
        try {
            $sens->save();
        } catch (QueryException $query_exception) {
            Log::error($query_exception->getMessage());
            return null;
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

//    public function store(StoreProductRequest $request)
//    {
//        $product = products::create($request->all());
//        return redirect()->route('admin.products.index');
//    }

    public function paginate($service_id)
    {
        return Sens::where('service_id', $service_id)->paginate();
    }

    public function getFirstSens(int $service_id)
    {
        return Sens::where('service_id', $service_id)
            ->orderBy('id', 'asc')->first();
    }

    public function getSens(int $service_id, int $lessonId)
    {
        return Sens::where('service_id', $service_id)->where('id', $lessonId)->first();
    }


//    /**
//     * Store a newly created resource in storage.
//     * @param Service $service_id
//     * @param $value
//     * @param Sens $sens
//     * @return bool
//     */
//    public function update(Service $service_id, $value, Sens $sens): bool
//    {
//        $sens->volume = $value['volume'];
//        $sens->start = $value['start'];
//        $sens->end = $value['end'];
//        $sens->start_at = $value['start_at'];
//        $sens->expire_at = $value['expire_at'];
//        $sens->service_id = $service_id;
//        $sens->user_id = auth()->id();
//        try {
//            $sens->save();
//        } catch (QueryException $query_exception) {
//            Log::error($query_exception->getMessage());
//            return false;
//        }
//        return true;
//    }


//    public function update($id, $service_id, $value)
//    {
//        return Sens::where('id', $id)->update([
//            "volume" => $value->volume,
//            "start" => $value->start,
//            "end" => $value->end,
//            "start_at" => $value->start_at,
//            "expire_at" => $value->expire_at,
//            "service_id" => $service_id,
//            "user_id" => auth()->id(),
//        ]);
////        try {
////            $sens->save();
////        } catch (QueryException $query_exception) {
////            Log::error($query_exception->getMessage());
////            return false;
////        }
////        return true;
//    }


}
