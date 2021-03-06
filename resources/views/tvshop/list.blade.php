@extends ('tvshop\layout')

{{--@dd(auth()->user())--}}

@section('content')
    <h1>TV Shop</h1>

    <div class="flex-container">
        @foreach ($allTv as $tv)
            <div>
                <img src="{{ asset('storage/' . $tv->path) }}" alt="{{$tv->model}} TV">
                <h2>{{ $tv->model }}</h2>
                <ul>
                    <li>Price: {{ $tv->price }}</li>

                    @can('admin')
                    <form method="POST" action="/destroy">
                        @csrf
                        <button name="delete_tv_id" value="{{ $tv->id }}" type="submit">Delete this</button>
                    </form>

                    <a href="/edit/{{$tv->id}}">
                        <button>Edit this</button>
                    </a>
                    @endcan

{{--                    @auth--}}
                        @cannot('admin')
                    <a href="/cart/add/{{$tv->id}}">
                        <button>Add To Cart</button>
                    </a>
                        @endcannot
{{--                    @endauth--}}

                </ul>
            </div>
        @endforeach
    </div>

    <div>
        {{ $allTv->links()  }}
    </div>

@endsection
