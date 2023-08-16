@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="post" action="{{route('start.store')}}" >
    @csrf
    @method('post')
    <textarea name="tasks" placeholder="new To-do ">{{old('content')}}</textarea>
    <input type="submit" value=" store " />
</form>