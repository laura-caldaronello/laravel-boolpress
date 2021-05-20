@extends('layouts.app')

@section('content')
    @foreach ($posts as $post)
    <div>
        <a href="{{route('posts.show',['slug' => $post->slug])}}">{{$post->title}}</a>
    </div>
    @endforeach
@endsection