<?php

namespace Gym\Reserve\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use Gym\Reserve\Models\Reserve;
use Gym\Reserve\Repositories\Interfaces\OrderRepositoryInterface;
use Gym\Service\Models\Service;
use Gym\Service\Repositories\Interfaces\ServiceRepositoryInterface;
use Gym\User\Models\User;
use Gym\User\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * The price group repository instance.
     * @var UserRepositoryInterface
     * @var CategoryRepositoryInterface
     */
    protected UserRepositoryInterface $user_repository;
    protected CategoryRepositoryInterface $category_repository;
    protected ServiceRepositoryInterface $service_repository;
    protected OrderRepositoryInterface $order_repository;

    /**
     * Instantiate a new price group instance.
     * @param UserRepositoryInterface $user_repository
     * @param CategoryRepositoryInterface $category_repository
     * @param ServiceRepositoryInterface $service_repository
     * @param OrderRepositoryInterface $order_repository
     */
    public function __construct(UserRepositoryInterface     $user_repository,
                                CategoryRepositoryInterface $category_repository,
                                ServiceRepositoryInterface  $service_repository,
                                OrderRepositoryInterface $order_repository)
    {
        $this->user_repository = $user_repository;
        $this->category_repository = $category_repository;
        $this->service_repository = $service_repository;
        $this->order_repository = $order_repository;
    }

    /**
     * @param Request $request
     * @param User $users
     * @return JsonResponse
     */
    public function selectSearch(Request $request, User $users): JsonResponse
    {
        if ($request->has('q')) {
            $search = $request->q;
            $users = User::select("id", "name", "mobile")
                ->where('name', 'LIKE', "%$search%")
                ->orWhere('mobile', 'LIKE', '%' . (int)$search . '%')
                ->get();
        }
        return response()->json($users);
    }

    /**
     * @param $id
     * @param string|null $status
     * @return Application|Factory|View
     */
    public function index($id, string $status = null): View|Factory|Application
    {
        $categories = $this->category_repository->getCategoryStatus($id);
        $services = $this->service_repository->getAll();
        return view('Reserve::products.index', compact('services', 'categories'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function filter(Request $request): JsonResponse
    {
        $date = $request->date;
        $services = Service::with(['sens' => function ($q) use ($date) {
            $q->whereHas('reserves', function ($q) use ($date) {
                $q->whereDate('start_time', $date);
            });
        }, 'sens.reserves' => function ($q) use ($date) {
            $q->whereDate('start_time', $date);
        }])
            ->whereHas('reserves', function ($q) use ($date) {
                $q->whereDate('start_time', $date);
            })
            ->when($request->filled('category_id'), function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })->get();
        $users = $this->user_repository->getAll();
        $user = $request->user;
        $html = view('Reserve::products.filters', compact('services', 'user', 'users', 'date'))->render();
        session(['date' => $date]);
        session(['user' => $user]);
        if ($request->filled('category_id'))
            session(['category' => $request->category_id]);
        return response()->json($html);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getModal(Request $request): JsonResponse
    {
        $orders = $this->order_repository->getAll();
        $reserve = Reserve::with('users')->find($request->id);
        $html = view('Reserve::products.modal', compact('reserve', 'orders'))->render();
        return response()->json($html);
    }
}
