@extends('layouts.app')

@section('title','The list of Tasks')

@section('content')
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
</div>
@endsection