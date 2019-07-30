@extends('layouts.crm.dashboard')
@section('crm_content')
    <h1>Orders</h1>
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
        <tr>
            <th># ID</th>
            <th>User</th>
            <th>Host</th>
            <th>Favicon</th>
            <th>Price</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->id }} &lt;{{ $order->user->email }}&gt;</td>
            <td>{{ $order->host }}</td>
            <td><img src="{{ $order->favicon_url }}" /></td>
            <td>{{ number_format($order->price, 2) }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->updated_at }}</td>
            <td>
                <a href="{{ route('dashboard.orders.show', ['id' => $order->id]) }}" id="show"><i class="material-icons" role="presentation">list_alt</i></a>
                <div class="mdl-tooltip" data-mdl-for="show">
                    Show bets
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
