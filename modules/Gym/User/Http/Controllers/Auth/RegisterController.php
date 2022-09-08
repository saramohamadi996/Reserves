<?php

namespace Gym\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Gym\User\Models\User;
use Gym\User\Rules\ValidMobile;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     * @var string
     */
    protected string $redirectTo = '/';

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     * @param  array  $data
     * @return Validator
     */
    protected function validator(array $data): Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'min:9' , 'max:14', 'unique:users', new ValidMobile()],
            'password' => ['required', 'string', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    public function create(array $data)
    {
        $users = User::create([
            'name' => $data['name'],
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
        return view('User::Front.register');
    }
}
