<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class To_doController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        return view('index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $users = User::all();
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tasks' => "required|string",
            'user_id'=>"required"
        ]);
        TOdo::create($data);
        return redirect("start");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task=Todo::find($id);
        return view('show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $test = Todo::find($id);
        return view('edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'tasks' => "required|string"
        ]);
        Todo::where('id', $id)->update($data);
        return redirect("start");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id', $id)->delete(); //27
        //$test = Test::find($id);$test->delete(); another way to alternative one
        return redirect("start");
    }

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

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => "required",
            'password' => "required"
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect("start");
        }
        return redirect(route('login'))->with('error', 'login details are not valid');
    }
    
    public function registrationPost(Request $request)
    {
        $request->validate([
            'name' => "required",
            'email' => "required|email|unique:users",
            'password' => "required"
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
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
