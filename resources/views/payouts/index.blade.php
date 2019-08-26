@extends('layouts.crm.dashboard')
@section('crm_content')
    <h1>Withrawables</h1>
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp table100">
        <thead>
        <tr>
            <th>ID</th>
            <th>Client ID</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($payouts as $payout)
            <tr>
                <td><a href="{{ route('dashboard.payouts.show', ['payout' => $payout->id]) }}">{{ $payout->id }}</a></td>
                <td><a href="{{ route('dashboard.users.show', ['user' => $payout->user_id]) }}">{{ $payout->user_id }}</a></td>
                <td>{{ number_format($payout->amount, 2) }}</td>
                <td>{{ $payout->status }}</td>
                <td>{{ $payout->created_at }}</td>
                <td>{{ $payout->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('pagination.default', ['paginator' => $payouts])
@endsection
