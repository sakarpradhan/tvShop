@extends('tvshop/layout')



@section('content')
    <table style="border: black solid 2px; width: 600px">
        <tr>
            <th>TV Name</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Subtotal</th>
        </tr>
        @foreach($carts as $cart)
            <tr>
                <td>{{ $cart->tv->model }}</td>
                <td>{{ $cart->quantity }}</td>
                <td>{{ $cart->tv->price }}</td>
                <td>{{ $cart->quantity * $cart->tv->price }}</td>
                <td>
                    <a href="/cart/delete/{{$cart->id}}">
                        <button>Remove</button>
                    </a>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">Total</td>
            <td>{{ $total }}</td>
        </tr>
    </table>
    <form method="POST" action="/cart/checkout">
        @csrf
        <button type="submit" style="margin: 20px; padding: 10px">BUY</button>
    </form>
@endsection
