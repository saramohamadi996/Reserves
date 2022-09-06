<?php

namespace Gym\Sens\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gym\Sens\Repositories\Interfaces\SensRepositoryInterface;
use Gym\Service\Models\Service;
use Gym\Service\Repositories\Interfaces\ServiceRepositoryInterface;
use Gym\PriceGroup\Repositories\Interfaces\PriceGroupRepositoryInterface;
use Gym\Sens\Models\Sens;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SensController extends Controller
{
    /**
     * The senses ' repository instance.
     * @var PriceGroupRepositoryInterface
     * @var ServiceRepositoryInterface
     */
    protected PriceGroupRepositoryInterface $price_group_repository;
    protected ServiceRepositoryInterface $service_repository;
    protected SensRepositoryInterface $sens_repository;

    /**
     * Instantiate a new senses ' instance.
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

    /**
     * create the form for creating a new resource.
     * @param $service_id
     * @param $id
     * @param string|null $status
     * @return Application|Factory|View
     */
    public function create($service_id,$id, string $status = null): View|Factory|Application
    {
        $price_groups = $this->price_group_repository->getPriceGroupStatus($id);
        $service = $this->service_repository->getById($service_id);
        return view('Sens::create', compact('service', 'price_groups'));
    }

    /**
     * Store a new created resource in storage.
     * @param $service_id
     * @param Request $request
     * @return RedirectResponse
     */
    public function store($service_id, Request $request): RedirectResponse
    {
       $service= $this->service_repository->getById($service_id);
        $input = $request->only(['user_id', 'price_group_id', 'service_id', 'volume',
            'status', 'day', 'start', 'end', 'start_at', 'expire_at']);
        $sens = $this->sens_repository->store($service, $input);
        if (!$sens) {
            return redirect()->back()->with('error', 'عملیات ذخیره سازی با شکست مواجه شد.');
        }
        return redirect()->route('services.details', $service_id);
    }

    /**
     * Show the form for editing the specified resource.
     * @param $service_id
     * @param int $sens_id
     * @param $id
     * @param string|null $status
     * @return Application|Factory|View
     */
    public function edit($service_id, int $sens_id, $id, string $status = null): View|Factory|Application
    {
        $price_groups = $this->price_group_repository->getPriceGroupStatus($id);
        $service = $this->service_repository->getById($service_id);
        $sens = $this->sens_repository->getById($sens_id);
        return view('Sens::edit', compact('service', 'price_groups','sens'));
    }


    public function update($service_id, int $sens_id, Request $value)
    {
        $sens = $this->sens_repository->getById($sens_id);

        $sens->update($value->all());

        if ($sens->wasChanged(['day','start','end','start_at','expire_at','day'])){
            $sens->reserves()->delete();
            $this->sens_repository->createReserves($sens);
        }
        return redirect()->route('services.details', $service_id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $price_group = $this->sens_repository->getById($id);
        $price_group = $this->sens_repository->delete($price_group);
        if (!$price_group) {
            return redirect()->back()->with('error', 'عملیات حذف با شکست مواجه شد.');
        }
        return redirect()->back()->with('success', 'عملیات حذف با موفقیت شد.');
    }

    /**
     * change status price group
     * @param int $id
     * @return RedirectResponse
     */
    public function toggle(int $id): RedirectResponse
    {
        $price_group = $this->sens_repository->getById($id);
        $input = ['status' => !$price_group->status];
        $result = $this->sens_repository->update($input, $price_group);
        if (!$result) {
            return redirect()->back()->with('error', 'فعالسازی با مشکل مواجه شد');
        }
        return redirect()->back()->with('success', 'فعال شد');
    }
}
