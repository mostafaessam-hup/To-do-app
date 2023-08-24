@extends('layout')
@section('title','Home page')
@section('content')

your tasks is
<ol>@foreach($todos as $todo)
    @if($todo->user_id==auth()->user()->id)
    <li> {{$todo->tasks}}</li>
    <a href="{{route('start.edit',$todo->id)}}">Edit</a>
    <a href="{{route('start.show',$todo->id)}}">Show</a>

    <form method="post" action="{{route('start.destroy',$todo->id)}}">
        @csrf
        @method('delete')
        <input type="submit" value="DELETE " /> 
        <br>
        <br>
        
    </form>
    @endif

    @endforeach
    <a href="start/create">create new to-do</a>
</ol>
@endsection