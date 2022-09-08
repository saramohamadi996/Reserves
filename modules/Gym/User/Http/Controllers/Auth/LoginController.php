<?php

namespace Gym\User\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * @var string
     */
    protected string $redirectTo = '/users';

    public function username()
    {
        return 'mobile';
    }

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//    /**
//     * @param Request $request
//     * @return array
//     */
//    protected function credentials(Request $request): array
//    {
//        if(is_numeric($request->get('email'))){
//            return ['mobile'=>$request->get('email'),'password'=>$request->get('password')];
//        }
//        elseif (filter_var($request->get('email'))) {
//            return ['email' => $request->get('email'), 'password'=>$request->get('password')];
//        }
////        return ['username' => $request->get('email'), 'password'=>$request->get('password')];
//    }

    /**
     * @return Factory|View|Application
     */
    public function showLoginForm(): Factory|View|Application
    {
        return view('User::Front.login');
    }

}
