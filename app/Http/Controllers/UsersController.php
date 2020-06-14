<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateUpdateUser;
use App\Http\Requests\ValidateUpdateUserMoney;
use App\Http\Requests\ValidateUpdateUserPassword;
use App\Mail\RegisteredUser;
use App\User;
use App\Http\Requests\ValidateRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateRegister $request)
    {
        $user = $this->createUser($request->validated());

        $user->createShoppingCart();

        Auth::guard()->login($user);

        Mail::to($user->email)->send(
            new RegisteredUser($user)
        );

        return redirect('/');
    }

    public function show(){
        return view('profile');
    }

    public function update(ValidateUpdateUser $request){

        $input = $request->only('name', 'email');

        auth()->user()->update($input);

        return redirect('/profile');
    }

    public function updateUserPassword(ValidateUpdateUserPassword $request){
        $input = $request->only('password');
        $input['password'] = Hash::make($input['password']);

        auth()->user()->update($input);

        return redirect('/profile');
    }


    public function updateUserMoney(ValidateUpdateUserMoney $request){
        $input = $request->only('money');

        $input['money'] =  $input['money'] + auth()->user()->money;

        auth()->user()->update($input);



        return redirect('/profile');
    }



    public function createUser(array $data){

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
