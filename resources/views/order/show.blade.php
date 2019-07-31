@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">{{ __('Order data') }} : {{ $order->id }}</h2>
                </div>
                <div class="mdl-card__supporting-text mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col" style="position: relative;">
                        <div class="mdl-list">
                            <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('Host') }}:</b></span>
                                </span>
                                    <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">{{ $order->host }}</span>
                                </span>
                            </div>
                            <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('User') }}:</b></span>
                                </span>
                                    <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">{{ $order->user->id }} | {{ $order->user->email }}</span>
                                </span>
                            </div>
                            <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('Transaction') }}:</b></span>
                                </span>
                                <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">{{ $order->transaction->transaction_id }}</span>
                                </span>
                            </div>
                            <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('Status') }}:</b></span>
                                </span>
                                <order-status status="{{ $order->status }}" order-id="{{ $order->id }}" />
                            </div>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-list">
                            <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('Price') }}:</b></span>
                                </span>
                                <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">{{ $order->price }}</span>
                                </span>
                            </div>
                            <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('Created at') }}:</b></span>
                                </span>
                                <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">{{ $order->created_at }}</span>
                                </span>
                            </div>
                            <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('Updated at') }}:</b></span>
                                </span>
                                <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">{{ $order->updated_at }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <h1>Bets</h1>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                <thead>
                <tr>
                    <th># ID</th>
                    <th>Line</th>
                    <th>Extra balls</th>
                    <th>Extra games</th>
                    <th>Ticket number</th>
                    <th>Number shield</th>
                    <th>Draw date</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Brand</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->bets as $bet)
                <tr>
                    <td>{{ $bet->id }}</td>
                    <td>{{ implode(',', $bet->line) }}</td>
                    <td>{{ implode(',', $bet->extra_balls) }}</td>
                    <td>{{ implode(',', $bet->extra_games) }}</td>
                    <td>{{ $bet->ticket_number }}</td>
                    <td>{{ $bet->number_shield == true ? 'Yes' : 'No' }}</td>
                    <td>{{ $bet->draw_date->format('d-m-Y') }}</td>
                    <td>{{ $bet->price }}</td>
                    <td>{{ $bet->status }}</td>
                    <td>{{ $bet->brand->name }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
