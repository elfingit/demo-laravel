@extends('layouts.crm.dashboard')
@section('crm_content')
    <h1>Bets</h1>
    <div class="mdl-card search-filters">
        <form action="" method="get" id="user_search">
            <div class="mdl-card__title">
                <span>Filters:</span>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="order_id" name="order_id" value="{{ old('order_id') ? old('order_id') : request('order_id') }}">
                    <label class="mdl-textfield__label" for="id">Order ID</label>
                </div>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                    Search
                </button>
                <filters-reset-button v-bind:form-id="'user_search'"></filters-reset-button>
            </div>
        </form>
    </div>
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
        <tr>
            <th># ID</th>
            <th>Draw date</th>
            <th>Price</th>
            <th>Status</th>
            <th>Brand</th>
            <th>User</th>
            <th>Order</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bets as $bet)
        <tr>
            <td>{{ $bet->id }}</td>
            <td>{{ $bet->draw_date->format('d-m-Y') }}</td>
            <td>{{ number_format($bet->price, 2) }}</td>
            <td>{{ $bet->status }}</td>
            <td>{{ $bet->brand->name }}</td>
            <td>{{ $bet->user->id }} | {{ $bet->user->email }}</td>
            <td><a href="{{ route('dashboard.orders.show', ['order' => $bet->order_id]) }}">{{ $bet->order->id }}</a> </td>
            <td>{{ $bet->created_at }}</td>
            <td>{{ $bet->updated_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
