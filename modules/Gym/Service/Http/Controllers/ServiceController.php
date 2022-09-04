<?php

namespace Gym\Service\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use Gym\Sens\Repositories\Interfaces\SensRepositoryInterface;
use Gym\Service\Http\Requests\ServiceUpdateRequest;
use Gym\Service\Models\Service;
use Gym\Service\Repositories\Interfaces\ServiceRepositoryInterface;
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
    public function __construct(ServiceRepositoryInterface $service_repository,
                                CategoryRepositoryInterface       $category_repository,
                                SensRepositoryInterface $sens_repository)
    {
        $this->service_repository = $service_repository;
        $this->category_repository = $category_repository;
        $this->sens_repository = $sens_repository;
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $services = $this->service_repository->getAll();
        return view('Service::Service.index', compact('services'));
    }

    /**
     * create step one the form for creating a new resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function createStepOne(Request $request): View|Factory|Application
    {
        $service = $request->session()->get('service');
        return view('Service::Service.create-step-one', compact('service'));
    }

    /**
     * post create step one a new created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function postCreateStepOne(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            "title" => 'required|min:3|max:190',
            "slug" => 'nullable|string|min:3|max:190',
        ]);
        if(empty($request->session()->get('service'))) {
            $service = new Service();
        } else {
            $service = $request->session()->get('service');
        }
        $service->fill($validatedData);
        $request->session()->put('service', $service);
        return redirect()->route('services.create.step.two');
    }

    /**
     * create step two the form for creating a new resource.
     * @param Request $request
     * @param $id
     * @param string|null $status
     * @return Application|Factory|View
     */
    public function createStepTwo(Request $request, $id,string $status = null): View|Factory|Application
    {
        $service = $request->session()->get('service');
        $categories = $this->category_repository->getCategoryStatus($id);
        return view('Service::Service.create-step-two',
            compact('service', 'categories'));
    }

    /**
     * post create step two a new created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function postCreateStepTwo(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            "category_id" => 'required|exists:categories,id',
            "code_service" => 'nullable|min:3|max:190',
            "priority" => 'nullable|numeric|min:0',
        ]);
        $service = $request->session()->get('service');
        $service->fill($validatedData);
        $request->session()->put('service', $service);
        return redirect()->route('services.create.step.three');
    }

    /**
     * create step three the form for creating a new resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function createStepThree(Request $request): View|Factory|Application
    {
        $service = $request->session()->get('service');
        $sense = $this->sens_repository->getAll();
        return view('Service::Service.create-step-three', compact('service', 'sense'));
    }

    /**
     * post create step three a new created resource in storage.
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
     * @return Application|Factory|View
     */
    public function edit(int $service_id): View|Factory|Application
    {
        $categories = $this->category_repository->getAll();
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
        $input = $request->only(['status', 'title', 'slug', 'code_service', 'priority', 'category_id']);
        $result = $this->service_repository->update($input, $service);
        if (!$result) {
            return redirect()->back()->with('error', 'عملیات بروزرسانی با شکست مواجه شد.');
        }
        return redirect()->route('services.index')->with('success', 'عملیات بروزرسانی با موفقیت انجام شد.');
    }

    /**
     * Display the list of service senses from the source.
     * @param int $id
     * @return Application|Factory|View
     */
    public function details(int $id): View|Factory|Application
    {
        $service = $this->service_repository->getById($id);
        $senses = $service->sens()->paginate(20);
        return view('Service::Service.details', compact('service', 'senses'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $service = $this->service_repository->getById($id);
        $service = $this->service_repository->delete($service);
        if (!$service) {
            return redirect()->back()->with('error', 'عملیات حذف با شکست مواجه شد.');
        }
        return redirect()->back()->with('success', 'عملیات حذف با موفقیت شد.');
    }


    /**
     * change status service
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
