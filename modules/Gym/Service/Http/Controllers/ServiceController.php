<?php

namespace Gym\Service\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Category\Models\Category;
use Gym\Category\Repositories\Interfaces\CategoryRepositoryInterface;
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

    /**
     * Instantiate a new service instance.
     * @param ServiceRepositoryInterface $service_repository
     * @param CategoryRepositoryInterface $category_repository
     */
    public function __construct(ServiceRepositoryInterface $service_repository,
                                CategoryRepositoryInterface       $category_repository)
    {
        $this->service_repository = $service_repository;
        $this->category_repository = $category_repository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $services = Service::all();
        return view('Service::Service.index', compact('services'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function createStepOne(Request $request): View|Factory|Application
    {
        $service = $request->session()->get('service');
        return view('Service::Service.create-step-one', compact('service'));
    }

    /**
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
            $service->fill($validatedData);
            $request->session()->put('service', $service);
        } else {
            $service = $request->session()->get('service');
            $service->fill($validatedData);
            $request->session()->put('service', $service);
        }
        return redirect()->route('services.create.step.two');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function createStepTwo(Request $request): View|Factory|Application
    {
        $service = $request->session()->get('service');
        $categories = Category::all()
            ->where('is_enabled', '=', 1);
        return view('Service::Service.create-step-two',
            compact('service', 'categories'));
    }

    /**
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
     * @param Request $request
     * @return Application|Factory|View
     */
    public function createStepThree(Request $request): View|Factory|Application
    {
        $service = $request->session()->get('service');
        $sense = Sens::all();
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
     * @return Application|Factory|View
     */
    public function edit(int $service_id): View|Factory|Application
    {
        $id=[];
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
        $input = $request->only(['is_enabled', 'title', 'slug', 'code_service', 'priority', 'category_id']);
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
        $service = Service::find($id);
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
        $input = ['is_enabled' => !$service->is_enabled];
        $result = $this->service_repository->update($input, $service);
        if (!$result) {
            return redirect()->back()->with('error', 'فعالسازی با مشکل مواجه شد');
        }
        return redirect()->back()->with('success', 'فعال شد');
    }

}
