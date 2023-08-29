<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    
    public function login()
    {
        if(Auth::check()){
            return redirect("start");
        }
        return view('login');
    }
    public function registration()
    {
        if(Auth::check()){
            return redirect("start");
        }
        return view('registration');
    }

    public function loginPost(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            return redirect("start");
        }
        return redirect(route('login'))->with('error', 'login details are not valid');
    }
    
    public function registrationPost(RegistrationRequest $request)
    {
        $data=$request->validated();
        $user = User::create($data);
        if (!$user) {
            return redirect(route('registration'))->with('error', 'Registration faild');
        }
        return redirect(route('login'))->with("success", "registration success.now login");
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
