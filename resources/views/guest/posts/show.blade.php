@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2>{{$post->title}}</h2>
                <h4>by {{$post->user->name}}</h4>
                <h5>Categoria: {{$post->category->name}}</h5>
                <p>{{$post->text}}</p>
            </div>
        </div>
    </div>
@endsection