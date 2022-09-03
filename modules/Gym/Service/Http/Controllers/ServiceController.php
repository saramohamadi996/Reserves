<?php

namespace Gym\Service\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use Gym\Sens\Repositories\Interfaces\SensRepositoryInterface;
use Gym\Service\Http\Requests\ServiceStoreRequest;
use Gym\Service\Http\Requests\ServiceUpdateRequest;
use Gym\Service\Models\Service;
use Gym\Service\Repositories\Interfaces\ServiceRepositoryInterface;
use Gym\Sens\Models\Sens;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * The service repository instance.
     * @var ServiceRepositoryInterface
     * @var CategoryRepositoryInterface
     */
    protected ServiceRepositoryInterface $service_repository;
    protected CategoryRepositoryInterface $category_repository;
    protected SensRepositoryInterface $sens_repository;

    /**
     * Instantiate a new service instance.
     * @param ServiceRepositoryInterface $service_repository
     * @param CategoryRepositoryInterface $category_repository
     * @param SensRepositoryInterface $sens_repository
     */
    public function __construct(ServiceRepositoryInterface  $service_repository,
                                CategoryRepositoryInterface $category_repository,
                                SensRepositoryInterface     $sens_repository)
    {
        $this->service_repository = $service_repository;
        $this->category_repository = $category_repository;
        $this->sens_repository = $sens_repository;
    }

    /**
     * @param $id
     * @param string|null $status
     * @return Application|Factory|View
     */
    public function index($id, string $status = null): View|Factory|Application
    {
        $services = $this->service_repository->getAll($id);
        return view('Service::Service.index', compact('services'));
    }

    /**
     * @param Request $request
     * @param $id
     * @param string|null $status
     * @return Application|Factory|View
     */
    public function createStepOne(Request $request, $id, string $status = null): View|Factory|Application
    {
        $categories = $this->category_repository->getCategoryStatus($id);
        $service = $request->session()->get('service');
        return view('Service::Service.create-step-one', compact('service', 'categories'));
    }

    /**
     * @param ServiceStoreRequest $request
     * @return RedirectResponse
     */
    public function postCreateStepOne(ServiceStoreRequest $request): RedirectResponse
    {
        $input = $request->only('title', 'category_id');

        if (empty($request->session()->get('service'))) {
            $service = new Service();
        } else {
            $service = $request->session()->get('service');
        }
        $service->fill($input);
        $request->session()->put('service', $service);
        return redirect()->route('services.create.step.two');
    }

    /**
     * @param ServiceStoreRequest $request
     * @return Application|Factory|View
     */
    public function createStepTwo(ServiceStoreRequest $request): View|Factory|Application
    {
        $service = $request->session()->get('service');
        return view('Service::Service.create-step-two',
            compact('service'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postCreateStepTwo(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            "code_service" => 'nullable|min:3|max:190',
            "priority" => 'nullable|numeric|min:0',
        ]);
        $service = $request->session()->get('service');
        $service->fill($validatedData);
        $request->session()->put('service', $service);
        return redirect()->route('services.create.step.three');
    }

    /**
     * @param Request $request
     * @param $id
     * @param string|null $status
     * @return Application|Factory|View
     */
    public function createStepThree(Request $request,$id, string $status = null): View|Factory|Application
    {
        $service = $request->session()->get('service');
        $sense = $this->sens_repository->getAll($id);
        return view('Service::Service.create-step-three', compact('service', 'sense'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postCreateStepThree(Request $request): RedirectResponse
    {
        $service = $request->session()->get('service');
        $service->save();
        $request->session()->forget('service');
        return redirect()->route('services.details', $service);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $service_id
     * @param $id
     * @param string|null $status
     * @return Application|Factory|View
     */
    public function edit(int $service_id, $id, string $status = null): View|Factory|Application
    {
        $categories = $this->category_repository->getAll($id);
        $service = $this->service_repository->getById($service_id);
        return view('Service::Service.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @param ServiceUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        $service = $this->service_repository->getById($id);
        $input = $request->only(['status', 'title', 'code_service', 'priority', 'category_id']);
        $result = $this->service_repository->update($input, $service);
        if (!$result) {
            return redirect()->back()->with('error', 'عملیات بروزرسانی با شکست مواجه شد.');
        }
        return redirect()->route('services.index')->with('success', 'عملیات بروزرسانی با موفقیت انجام شد.');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function details($id): View|Factory|Application
    {
        $service = $this->service_repository->getById($id);
        $senses = $service->sens()->paginate(20);
        return view('Service::Service.details', compact('service', 'senses'));
    }

    /**
     * enable banner
     * @param int $id
     * @return RedirectResponse
     */
    public function toggle(int $id): RedirectResponse
    {
        $service = $this->service_repository->getById($id);
        $input = ['status' => !$service->status];
        $result = $this->service_repository->update($input, $service);
        if (!$result) {
            return redirect()->back()->with('error', 'فعالسازی با مشکل مواجه شد');
        }
        return redirect()->back()->with('success', 'فعال شد');
    }

}
