@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>contatti</h1>
                <form action="{{route('contatti.sent')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">message</label>
                        <textarea name="message" type="message" class="form-control" id="message" placeholder="Enter message" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection