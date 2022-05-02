@extends ('tvshop.layout')

@section ('content')
    <h2>Login User</h2>
    <form action="/login" method="POST">
        @csrf

        <ul>Email: <input name="email" required></ul>
        @error('email')
        <ul><p>{{ $message }}</p></ul>
        @enderror

        <ul>Password: <input name="password" type="password" required></ul>
        @error('password')
        <ul><p>{{ $message }}</p></ul>
        @enderror

        <ul><button type="submit">Login</button></ul>
    </form>
@endsection
