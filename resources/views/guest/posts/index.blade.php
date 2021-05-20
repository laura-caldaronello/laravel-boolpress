@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2>Lista Post</h2>
                @foreach ($posts as $post)
                    <div>
                        <a href="{{route('posts.show',['slug' => $post->slug])}}">{{$post->title}}</a>
                    </div>
                @endforeach

                <h2>Post per categoria</h2>
                @foreach ($categories as $category)
                    <div>
                        <h4>Categoria: {{$category->name}}</h4>
                        @foreach ($category->post as $post)
                            <div>
                                <a href="{{route('posts.show',['slug' => $post->slug])}}">{{$post->title}}</a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection