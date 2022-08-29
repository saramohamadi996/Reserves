<?php

namespace Gym\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Category\Http\Requests\CategoryRequestStore;
use Gym\Category\Http\Requests\CategoryRequestUpdate;
use Gym\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * The category repository instance.
     * @var CategoryRepositoryInterface
     */
    protected CategoryRepositoryInterface $category_repository;

    /**
     * Instantiate a new category instance.
     * @param CategoryRepositoryInterface $category_repository
     */
    public function __construct(CategoryRepositoryInterface $category_repository)
    {
        $this->category_repository = $category_repository;
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $id =[];
        $categories = $this->category_repository->getAll($id);
        return view('Categories::index', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $category_id
     * @return Application|Factory|View
     */
    public function edit(int $category_id): View|Factory|Application
    {
        $category = $this->category_repository->getById($category_id);
        $categories = $this->category_repository->getAll($category_id);
        return view('Categories::edit', compact('category', 'categories'));
    }

    /**
     * create the form for creating a new resource.
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $id=[];
        $categories = $this->category_repository->getAll($id);
        return view('Categories::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CategoryRequestStore $request
     * @return RedirectResponse
     */
    public function store(CategoryRequestStore $request): RedirectResponse
    {
        $input = $request->only('title', 'slug', 'parent_id');
        $categories = $this->category_repository->store($input);
        if (!$categories) {
            return redirect()->back()->with('error', 'عملیات ذخیره سازی با شکست مواجه شد.');
        }
        return redirect()->route('categories.index')->with('success', 'عملیات ذخیره سازی با موفقیت انجام شد.');
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @param CategoryRequestUpdate $request
     * @return RedirectResponse
     */
    public function update(int $id, CategoryRequestUpdate $request): RedirectResponse
    {
        $category = $this->category_repository->getById($id);
        $input = $request->only('title', 'slug', 'parent_id', 'is_enabled');
        $result = $this->category_repository->update($category, $input);
        if (!$result) {
            return redirect()->back()->with('error', 'عملیات بروزرسانی با شکست مواجه شد.');
        }
        return redirect()->route('categories.index')->with('success', 'عملیات بروزرسانی با موفقیت انجام شد.');
    }

    /**
     * enable banner
     * @param int $id
     * @return RedirectResponse
     */
    public function toggle(int $id): RedirectResponse
    {
        $category = $this->category_repository->getById($id);
        $input = ['is_enabled' => !$category->is_enabled];
        $result = $this->category_repository->update($input, $category);
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
        $category = $this->category_repository->getById($id);
        $category = $this->category_repository->delete($category);
        if (!$category) {
            return redirect()->back()->with('error', 'عملیات حذف با شکست مواجه شد.');
        }
        return redirect()->back()->with('success', 'عملیات حذف با موفقیت شد.');
    }


}
