<?php

namespace Gym\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Gym\User\Http\Requests\UpdateUserRequest;
use Gym\User\Models\User;
use Gym\User\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * The category repository instance.
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $user_repository;

    /**
     * Instantiate a new category instance.
     * @param UserRepositoryInterface $user_repository
     */
    public function __construct(UserRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $input = $request->all();
        $users=$this->user_repository->paginate($input);
        return view("User::Admin.index", compact('users'));
    }

    /**
     * @param $userId
     * @return View|Factory|Application
     */
    public function edit($userId): View|Factory|Application
    {
        $user = $this->user_repository->getById($userId);
        return view("User::Admin.edit", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @param UpdateUserRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        $card = $this->user_repository->getById($id);
        $input = $request->only(['status', 'name', 'username', 'email', 'mobile', 'role', 'password',]);
        $result= $this->user_repository->update($input, $card);
        if (!$result) {
            return redirect()->back()->with('error', 'عملیات بروزرسانی با شکست مواجه شد.');
        }
        return redirect()->route('users.index')->with('success', 'عملیات بروزرسانی با موفقیت انجام شد.');
    }

}
