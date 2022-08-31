<?php

namespace Gym\Sens\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gym\Sens\Repositories\Interfaces\SensRepositoryInterface;
use Gym\Service\Repositories\Interfaces\ServiceRepositoryInterface;
use Gym\PriceGroup\Repositories\Interfaces\PriceGroupRepositoryInterface;
use Gym\Sens\Models\Sens;
use Gym\Service\Models\Service;
use Illuminate\Http\Request;

class SensController extends Controller
{
    /**
     * The price_group repository instance.
     * @var PriceGroupRepositoryInterface
     * @var ServiceRepositoryInterface
     */
    protected PriceGroupRepositoryInterface $price_group_repository;
    protected ServiceRepositoryInterface $service_repository;
    protected SensRepositoryInterface $sens_repository;

    /**
     * Instantiate a new price_group instance.
     * @param PriceGroupRepositoryInterface $price_group_repository
     * @param ServiceRepositoryInterface $service_repository
     * @param SensRepositoryInterface $sens_repository
     */
    public function __construct(PriceGroupRepositoryInterface $price_group_repository,
                                ServiceRepositoryInterface    $service_repository,
                                SensRepositoryInterface       $sens_repository)
    {
        $this->price_group_repository = $price_group_repository;
        $this->service_repository = $service_repository;
        $this->sens_repository = $sens_repository;
    }

    public function create($service_id)
    {
        $price_groups = $this->price_group_repository->getAll();
        $service = $this->service_repository->getById($service_id);
        return view('Sens::create', compact('service', 'price_groups'));
    }

    public function edit($service_id, int $sens_id)
    {
        $price_groups = $this->price_group_repository->getAll();
        $service = $this->service_repository->getById($service_id);
        $sens = $this->sens_repository->getById($sens_id);
        return view('Sens::edit', compact('service', 'price_groups','sens'));
    }


    public function store($service_id, Request $value)
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
        return redirect()->route('services.details', $service_id);
    }

    private function createReserves(Sens $sens)
    {
        $start_at = Carbon::parse($sens->start_at);
        $expire_at = Carbon::parse($sens->expire_at);
        $start = Carbon::parse($sens->start);
        $end = Carbon::parse($sens->end);
        for ($date = $start_at; $date->lte($expire_at); $date->addDay()) {
            if (in_array($date->dayOfWeek, $sens->toArray()['day'])) {
                $start_datetime = $date->copy()->addHours($start->hour)->addMinutes($start->minute);
                $end_datetime = $date->copy()->addHours($end->hour)->addMinutes($end->minute);
                $sens->reserves()->create([
                    'start_time' => $start_datetime,
                    'end_time' => $end_datetime,
                ]);
            }
        }
        return true;
    }


}
