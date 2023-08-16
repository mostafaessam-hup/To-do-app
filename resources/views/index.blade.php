<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    this is all tasks
    <br>
    <a href="start/create">create new to-do</a>
    <ul>@foreach($todos as $todo)
        <li>{{$todo->tasks}}</li>
        <li>id is {{$todo->id}}</li>
        <a href="{{route('start.edit',$todo->id)}}">Edit</a>

        <form method="post" action="{{route('start.destroy',$todo->id)}}">
            @csrf
            @method('delete')
            <input type="submit" value="DELETE " />
        </form>

        @endforeach
    </ul>





</body>

</html>