@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2>Categoria: {{$category->name}}</h2>
                @foreach ($category->post as $post)
                    <h4>
                        <a href="{{route('posts.show',['slug' => $post->slug])}}">{{$post->title}}</a>
                    </h4>
                @endforeach
            </div>
        </div>
    </div>
@endsection