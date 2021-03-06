@extends('layouts.crm.dashboard')
@section('crm_content')
    <h1>Withrawables</h1>
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp table100">
        <thead>
        <tr>
            <th>ID</th>
            <th>Client ID</th>
            <th>Bet ID</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->transaction_id }}</td>
                <td><a href="{{ route('dashboard.users.show',
                ['user' => $transaction->balance->user->id]) }}">{{ $transaction->balance->user->id }}</a></td>
                <td><a href="{{ route('dashboard.bets.show', ['bet' => $transaction->bet_id]) }}">{{ $transaction->bet_id }}</a></td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->status }}</td>
                <td>{{ $transaction->created_at }}</td>
                <td>{{ $transaction->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('pagination.default', ['paginator' => $transactions])
@endsection
