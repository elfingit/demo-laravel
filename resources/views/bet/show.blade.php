@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col show-header">
            <div class="item">Draw bet: {{ $bet->id }}</div>
            <div class="item status"><span>Status: </span><bet-status bet-id="{{ $bet->id }}" status="{{ $bet->status }}" :statuses="{{ json_encode(\Bet::getStatuses()) }}" /></div>
            <div class="item"><count-down-timer date="'{{ $bet->draw_date->toRfc850String() }}'" status="'{{ $bet->status }}'" /> </div>
            <div class="item">Order
                <a href="{{ route('dashboard.orders.show', ['order' => $bet->order_id]) }}">{{ $bet->order_id }}</a>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__supporting-text">
                    <h3>Client</h3>
                    <div class="mdl-list">
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('ID') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">
                                    <a href="{{ route('dashboard.users.show', ['user_id' => $bet->user_id]) }}">{{ $bet->user_id }}</a></span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Name') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $bet->user->profile->first_name }} {{ $bet->user->profile->last_name }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Email') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $bet->user->email }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Site') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $bet->user->profile->host }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Current Deposit') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">&euro; {{ $bet->user->available_balance->amount }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__supporting-text">
                    <h3>Bet Info</h3>
                    <div class="mdl-list">
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Brand') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">
                                    <a href="{{ route('dashboard.brands.show', ['brand' => $bet->brand_id]) }}">
                                        {{ $bet->brand->name }}
                                    </a>
                                </span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Draw date') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">
                                    {{ $bet->draw_date->format('d-m-Y H:i:s') }}
                                </span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Price') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">
                                    &euro;{{ number_format($bet->price, 2) }}
                                </span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Win amount') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">
                                    &euro;{{ number_format($bet->win_amount, 2) }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <h1>Tickets</h1>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                <thead>
                <tr>
                    <th># ID</th>
                    <th>Line</th>
                    <th>Extra balls</th>
                    <th>Extra games</th>
                    <th>Ticket number</th>
                    <th>Number shield</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Win amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bet->tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ implode(',', $ticket->line) }}</td>
                        <td>{{ implode(',', $ticket->extra_balls) }}</td>
                        <td>{{ implode(',', $ticket->extra_games_human) }}</td>
                        <td>{{ $ticket->ticket_number }}</td>
                        <td>{{ $ticket->number_shield == true ? 'Yes' : 'No' }}</td>
                        <td>{{ $ticket->price }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket->win_amount }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
