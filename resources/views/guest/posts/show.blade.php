@extends('layouts.app')

@section('content')
    <div>
        <h2>{{$post->title}}</h2>
        <h3>by {{$user->name}}</h3>
        <p>{{$post->text}}</p>
    </div>
@endsection