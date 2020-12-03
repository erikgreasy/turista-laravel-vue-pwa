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

    <form action="/trips" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="tripDate">Date of the trip: </label>
            <input type="date" class="form-control" name="date" id="tripDate">
        </div>
        <div class="form-group">

            @if ( $from_hill )
                
                <input type="number" value="{{ $from_hill }}"  name="hill" hidden>
            @else 
                <label for="hill">Hill: </label>

                <select name="hill" id="hill" class="form-control">

                    @foreach ($hills as $hill)
                        <option value="{{ $hill->id }}">
                            {{ $hill->name }}
                        </option>
                        
                    @endforeach
                </select>

            @endif

            
        </div>
        <div class="form-group">

            <label for="tripTitle">Title:</label>
            <input type="text" name="title" id="tripTitle" class="form-control" value="{{ old( 'title' ) }}">
        </div>
        <div class="form-group">
            <label for="tripDesc">Text: </label>
            <textarea name="description" id="tripDesc" cols="30" rows="10" class="form-control">{{ old( 'description' ) }}</textarea>
        </div>
        <div class="form-group">
            <input id="image" type="file" name="image[]" class="" multiple>
        </div>
        <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>

        

    </form>
    
@endsection