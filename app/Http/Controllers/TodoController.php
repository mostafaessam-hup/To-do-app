<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\User;


class TodoController extends Controller
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
    public function store(TodoRequest $request)
    {

        TOdo::create($request->validated());
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
    public function update(TodoRequest $request, string $id)
    {
        Todo::where('id', $id)->update($request->validated());
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

    
}
