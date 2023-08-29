@extends('layout')
@section('title','Registration')
@section('content')
<div class='container'>
    <div class="mt-2">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">
            <li>{{ session('error') }}</li>
        </div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success">
            <li>{{ session('success') }}</li>
        </div>
        @endif
    </div>
    <form action="{{route('registrationpost')}}" method="post" class="ms-auto me-auto mt-auto" style="width: 500px">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection