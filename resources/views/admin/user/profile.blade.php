@extends('layouts.dashboard')

@section('content')
    <h1>dati utente</h1>
    <h2>{{Auth::user()->name}}</h2>
    <h2>{{Auth::user()->email}}</h2>
    @if (Auth::user()->api_token)
        <h2>{{Auth::user()->api_token}}</h2>
    @else
        <form action="{{route('admin.generate_token')}}" method="post">
            @csrf
            <button type="submit">Genera token</button>
        </form>
    @endif
@endsection