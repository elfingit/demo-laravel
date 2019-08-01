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
                                <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">{{ $order->status }}</span>
                                </span>
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
                            <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('Bets') }}:</b></span>
                                </span>
                                <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">
                                        <a href="{{ route('dashboard.bets.index', ['order_id' => $order->id]) }}">See bets</a>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
