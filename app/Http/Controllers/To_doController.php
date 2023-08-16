<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class To_doController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos=Todo::all();
        return view('index',compact('todos'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'tasks'=>"required|string"
        ]);
        TOdo::create($data);
        return redirect("start"); 
    
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        return view('show');
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
        $data=$request->validate([
            'tasks'=>"required|string"
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
}
