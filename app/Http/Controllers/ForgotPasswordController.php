<?php

namespace App\Http\Controllers;

use App\ForgotPassword;
use App\Http\Requests\ValidateEmailForForgotPassword;
use App\Http\Requests\ValidateResetPassword;
use App\Mail\ForgotPasswordMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('password.forgot-password');
    }

    public function sendResetLinkEmail(ValidateEmailForForgotPassword $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        $token = $this->getToken(50);

        if (!empty($user)) {
            Mail::to($request->input('email'))->send(
                new ForgotPasswordMail($token)
            );
            ForgotPassword::create([
                'email' => $request->input('email'),
                'token' => $token
            ]);
        }

        return back()->with('status', 'A mail has been sent! Please verify your inbox');
    }

    public function showForm($token)
    {
        $forgotPassword = ForgotPassword::where('token', $token)->first();
        if (empty($forgotPassword)) {
            abort(404, 'Unauthorized action.');
        }
        return view('password.reset-password', compact('forgotPassword'));
    }

    public function resetPassword(ValidateResetPassword $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        $forgotPassword = ForgotPassword::where('token', $request->input('token'))->first();
        if (!empty($user) and !empty($forgotPassword) and $user->email === $forgotPassword->email) {

            $input = $request->only('password');
            $input['password'] = Hash::make($input['password']);
            $user->update($input);
            $forgotPassword->delete();
        } else {
            abort(403, 'Unauthorized action.');
        }
        return redirect('/login');
    }

    function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet);

        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }
        $token .= uniqid();

        return $token;
    }
}
