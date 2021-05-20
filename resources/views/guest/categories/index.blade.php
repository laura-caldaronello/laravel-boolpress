@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2>Categorie</h2>
                @foreach ($categories as $category)
                    <div>
                        <h4>
                            <a href="{{route('categories.show',['slug' => $category->slug])}}">{{$category->name}}</a>
                        </h4>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection