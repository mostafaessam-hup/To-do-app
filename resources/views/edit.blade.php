
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form method="post" action="{{Route('start.update',$test->id)}}" >
    @csrf
    @method('put')
    <textarea name="tasks" placeholder="new To-do " >{{$test->tasks}}</textarea>
    <textarea hidden name="user_id" placeholder="UserId ">{{auth()->user()->id}}</textarea><br>
    <input type="submit" value=" update " />
</form>