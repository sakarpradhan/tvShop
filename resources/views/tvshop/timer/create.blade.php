@extends('tvshop\layout')

@section('content')

    <h1>Display timer for TV</h1>
    <form method="POST" action="/timer">
        @csrf

        <ul>Select TV:
            <select name="tv_id">
                @foreach($allTv as $tv):
                    <option value="{{ $tv->id }}">{{ $tv->model }}</option>
                @endforeach
            </select>
        </ul>

        <ul>Display start: <input name="display_start" type="time"></ul>

        <ul>Display end: <input name="display_end" type="time"></ul>

        <ul>Remove after: <input name="remove_after" type="datetime-local"></ul>

        <button type="submit">Set Timer</button>

    </form>
@endsection
