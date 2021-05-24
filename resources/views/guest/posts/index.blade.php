@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2>Lista Post</h2>
                @foreach ($posts as $post)
                    <div>
                        <a href="{{route('posts.show',$post)}}">{{$post->title}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection