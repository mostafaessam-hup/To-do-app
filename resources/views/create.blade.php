@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="post" action="{{route('start.store')}}">
    @csrf
    @method('post')
    <textarea name="tasks" placeholder="new To-do ">{{old('content')}}</textarea><br>
    <textarea name="user_id" placeholder="UserId ">{{auth()->user()->id}}</textarea><br>
    
    

    <input type="submit" value=" store " />
</form>