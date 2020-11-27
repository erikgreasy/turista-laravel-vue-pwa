@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="/users/{{ $user->id }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" value="Update" class="btn btn-info">
        </div>


    </form>
    
@endsection