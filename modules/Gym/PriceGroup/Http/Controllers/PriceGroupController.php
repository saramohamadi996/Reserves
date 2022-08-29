<?php

namespace Gym\PriceGroup\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use Gym\PriceGroup\Http\Requests\PriceGroupStoreRequest;
use Gym\PriceGroup\Http\Requests\PriceGroupUpdateRequest;
use Gym\PriceGroup\Repositories\Interfaces\PriceGroupRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PriceGroupController extends Controller
{
    /**
     * The price_group repository instance.
     * @var PriceGroupRepositoryInterface
     * @var CategoryRepositoryInterface
     */
    protected PriceGroupRepositoryInterface $price_group_repository;
    protected CategoryRepositoryInterface $category_repository;

    /**
     * Instantiate a new price_group instance.
     * @param PriceGroupRepositoryInterface $price_group_repository
     * @param CategoryRepositoryInterface $category_repository
     */
    public function __construct(PriceGroupRepositoryInterface $price_group_repository,
                                CategoryRepositoryInterface       $category_repository)
    {
        $this->price_group_repository = $price_group_repository;
        $this->category_repository = $category_repository;
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $id=[];
        $categories = $this->category_repository->getAll($id);
        $price_groups = $this->price_group_repository->getAll();
        return view('PriceGroup::index', compact('price_groups', 'categories'));
    }

    /**
     * create the form for creating a new resource.
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $id=[];
        $categories = $this->category_repository->getAll($id)
            ->where('is_enabled', '=', 1);
        return view('PriceGroup::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PriceGroupStoreRequest $request
     * @return RedirectResponse
     */
    public function store(PriceGroupStoreRequest $request): RedirectResponse
    {
        $input = $request->only('title', 'price', 'category_id', 'user_id');
        $price_groups = $this->price_group_repository->store($input);
        if (!$price_groups) {
            return redirect()->back()->with('error', 'عملیات ذخیره سازی با شکست مواجه شد.');
        }
        return redirect()->route('price_groups.index')->with('success', 'عملیات ذخیره سازی با موفقیت انجام شد.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $price_group_id
     * @return Application|Factory|View
     */
    public function edit(int $price_group_id): View|Factory|Application
    {
        $id=[];
        $categories = $this->category_repository->getAll($id);
        $price_group = $this->price_group_repository->getById($price_group_id);
        return view('PriceGroup::edit', compact('price_group', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @param PriceGroupUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        $price_group = $this->price_group_repository->getById($id);
        $input = $request->only(['title', 'price', 'category_id', 'user_id','is_enabled']);
        $result = $this->price_group_repository->update($input, $price_group);
        if (!$result) {
            return redirect()->back()->with('error', 'عملیات بروزرسانی با شکست مواجه شد.');
        }
        return redirect()->route('price_groups.index')->with('success', 'عملیات بروزرسانی با موفقیت انجام شد.');
    }

    /**
     * enable banner
     * @param int $id
     * @return RedirectResponse
     */
    public function toggle(int $id): RedirectResponse
    {
        $price_group = $this->price_group_repository->getById($id);
        $input = ['is_enabled' => !$price_group->is_enabled];
        $result = $this->price_group_repository->update($input, $price_group);
        if (!$result) {
            return redirect()->back()->with('error', 'فعالسازی با مشکل مواجه شد');
        }
        return redirect()->back()->with('success', 'فعال شد');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $price_group = $this->price_group_repository->getById($id);
        $price_group = $this->price_group_repository->delete($price_group);
        if (!$price_group) {
            return redirect()->back()->with('error', 'عملیات حذف با شکست مواجه شد.');
        }
        return redirect()->back()->with('success', 'عملیات حذف با موفقیت شد.');
    }
}
