@extends('layouts.crm.dashboard')
@section('crm_content')
    <h1>Bets</h1>
    <div class="mdl-card search-filters">
        <form action="" method="get" id="bet_search">
            <div class="mdl-card__title">
                <span>Filters:</span>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="order_id" name="order_id" value="{{ old('order_id') ? old('order_id') : request('order_id') }}">
                    <label class="mdl-textfield__label" for="id">Order ID</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield">
                    <select name="status">
                        <option>Select status</option>
                        @foreach ($statuses as $key => $status)
                        <option value="{{ $key }}" {{ (old('status') == $key || request('status') == $key ) ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mdl-textfield mdl-js-textfield">
                    <select name="brand">
                        <option>Select brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ (old('brand') == $brand->id || request('brand') == $brand->id ) ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                    Search
                </button>
                <filters-reset-button v-bind:form-id="'bet_search'"></filters-reset-button>
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
            <td><a href="{{ route('dashboard.bets.show', ['bet' => $bet->id]) }}">{{ $bet->id }}</a></td>
            <td>{{ $bet->draw_date->format('d-m-Y') }}</td>
            <td>{{ number_format($bet->price, 2) }}</td>
            <td>{{ $bet->status }}</td>
            <td>{{ $bet->brand->name }}</td>
            <td>{{ $bet->user->id }} | {{ $bet->user->email }}</td>
            <td><a href="{{ route('dashboard.orders.show', ['order' => $bet->order_id]) }}">{{ $bet->order->id }}</a> </td>
            <td>{{ $bet->created_at }}</td>
            <td>{{ $bet->updated_at }}</td>
            <td>
                <a href="{{ route('dashboard.bets.show', ['bet' => $bet->id]) }}" id="visibility"><i class="material-icons" role="presentation">visibility</i></a>
                <div class="mdl-tooltip" data-mdl-for="visibility">
                    View bet info
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @include('pagination.default', ['paginator' => $bets])
@endsection
