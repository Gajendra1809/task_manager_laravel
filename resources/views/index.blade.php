@extends('layouts.app')

@section('title','The list of Tasks')

@section('content')
<div>
    <a href="{{route('tasks.create')}}">Create task</a>
</div>
<div>
    @if(count($tasks))
        @foreach($tasks as $task)
            <div>
                <a href="{{route('tasks.show',['task'=>$task->id])}}">{{$task->title}}</a>
            </div>
        @endforeach
    @else
        <div>There are no tasks</div>
    @endif

    @if($tasks->count())
        <nav>
        {{$tasks->links()}}
        </nav>
    @endif
</div>
@endsection