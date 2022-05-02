@extends ('tvshop\layout')

@section('content')
    <h1>Edit form for {{ $tv->model  }} TV</h1>

    <form action="/update/{{ $tv->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <ul>Model: <input name="model" value="{{$tv->model}}"/></ul>
        <ul>Price: <input name="price" value="{{$tv->price}}"/></ul>
        <ul>Image: <input type="file" name="path"/></ul>
        <ul><img width="150px" src="{{ asset('storage/' . $tv->path) }}" alt="Current picture: {{$tv->model}}"></ul>
        <p>
            <button type="submit">Update</button>
        </p>
    </form>

@endsection
