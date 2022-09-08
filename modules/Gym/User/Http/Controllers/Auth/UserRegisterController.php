<?php

namespace Gym\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Gym\User\Http\Requests\UserRegisterRequest;
use Gym\User\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     * @param UserRegisterRequest $data
     * @return RedirectResponse
     */
    public function create(UserRegisterRequest $data): RedirectResponse
    {
        $users= User::create([
            'staff_id' => auth()->id(),
            'name' => $data['name'],
//            'username' => $data['username'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
        return redirect()->route('users.index', compact('users'));
    }

    /**
     * @return Application|Factory|View
     */
    public function showRegistrationForm(): View|Factory|Application
    {
        return view('User::Front.user-register');
    }
}
