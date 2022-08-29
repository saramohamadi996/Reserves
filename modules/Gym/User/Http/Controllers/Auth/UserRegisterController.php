<?php

namespace Gym\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Gym\User\Http\Requests\RegisterRequest;
use Gym\User\Http\Requests\UserRegisterRequest;
use Gym\User\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     * @param RegisterRequest $data
     * @return RedirectResponse
     */
    public function create(UserRegisterRequest $data)
    {
        $users= User::create([
            'staff_id' => auth()->id(),
            'name' => $data['name'],
            'username' => $data['username'],
            'mobile' => $data['mobile'],
            'password' => 123456,
        ]);
        return redirect()->route('users.index', compact('users'));


    }

    public function showRegistrationForm()
    {
        return view('User::Front.user-register');
    }
}
