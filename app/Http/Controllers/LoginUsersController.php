<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateLogin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(ValidateLogin $request)
    {
        if ($this->attemptLogin($request)) {
            return redirect('/');
        }
        return redirect('/login')->withErrors('Email or password invalid');
    }

    protected function attemptLogin(Request $request)
    {

        return Auth::guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        ) ;
    }

    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }


    public function logout(){

        Auth::guard()->logout();

        return redirect('/');

    }

}
