@extends ('tvshop\layout')

@section('content')
    <h2>Register New User</h2>
    <form method="POST" action="/register">
        @csrf
        <ul>Name: <input name="name" value="{{ old('name') }}" required></ul>
        @error('name')
        <ul><p>{{ $message }}</p></ul>
        @enderror

        <ul>Email: <input name="email" type="email" value="{{ old('email') }}" required></ul>
        @error('email')
        <ul><p>{{ $message }}</p></ul>
        @enderror

        <ul>Password: <input name="password" type="password" required></ul>
        @error('password')
        <ul><p>{{ $message }}</p></ul>
        @enderror

        <ul>Admin: <input type="checkbox" name="admin" value="1"></ul>
        @error('admin')
        <ul><p>{{ $message }}</p></ul>
        @enderror

        <ul>
            <button type="submit">Create</button>
        </ul>

        @if ($errors->any())
            <h3>Errors:</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </ul>
        @endif

    </form>
@endsection
