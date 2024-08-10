<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{

    public function login()
    {
        if (Auth::check()) {
            return redirect("start");
        }
        return view('login');
    }
    public function registration()
    {
        if (Auth::check()) {
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
        $data = $request->validated();
        $user = new User();
        $image_name = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $image_name);
        $path = '/images/' . $image_name;
        $user = User::create($data);
        $user->image = $path;
        $user->save();
        if (!$user) {
            return redirect(route('registration'))->with('error', 'Registration faild');
        }
        return redirect(route('login'))->with("success", "registration success.now login");
    }

    public function profile()
    {
        return view('profile');
    }
    public function edit_profile()
    {
        return view('edit-profile');
    }

    public function update_profile(RegistrationRequest $request,  $id)
    {
        dd($request);
        return redirect("profile");
        $request->validated();
        $image_name = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $image_name);
        $path = '/images/' . $image_name;
        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->image = $path;
        User::where('id', $id)->update($request->validated());


    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
