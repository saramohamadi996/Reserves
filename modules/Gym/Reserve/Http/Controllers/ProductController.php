<?php

namespace Gym\Reserve\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\Category\Models\Category;
use Gym\Reserve\Models\Order;
use Gym\Reserve\Models\Reserve;
use Gym\Service\Models\Service;
use Gym\User\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function selectSearch(Request $request)
    {
        $users = [];
        if($request->has('q')){
            $search = $request->q;
            $users = User::select("id", "name", "mobile")
                ->where('name', 'LIKE', "%$search%")
                ->orWhere('mobile','LIKE','%'.(int)$search.'%')
                ->get();
        }
        return response()->json($users);
    }

    public function index(Request $request)
    {
        $categories = Category::all();
        $services = Service::with('sens')->paginate(1);
        return view('Reserve::products.index', compact('services', 'categories'));
    }

    public function filter(Request $request)
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
        $users = User::all();
        $user = $request->user;
        $html = view('Reserve::products.filters', compact('services', 'user', 'users', 'date'))->render();
        session(['date' => $date]);
        session(['user'=>$user]);
        if ($request->filled('category_id'))
            session(['category' => $request->category_id]);
        return response()->json($html);
    }

    public function getModal(Request $request)
    {
        $date = $request->date;
        $orders = Order::all();
        $reserve = Reserve::with('users')->find($request->id);
        $html = view('Reserve::products.modal', compact('reserve','orders'))->render();
        return response()->json($html);
    }
}
