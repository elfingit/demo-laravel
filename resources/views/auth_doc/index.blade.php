@extends('layouts.crm.dashboard')
@section('crm_content')
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp table100">
        <thead>
        <tr>
            <th>Doc</th>
            <th>Cliet ID</th>
            <th>Bet ID</th>
            <th>Possible Payout</th>
            <th>Doc downloads</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($docs as $doc)
            <tr>
                <td>{{ $doc->file_name }} (<a href="{{ route('dashboard.user.auth_docs.download', ['user' => $doc->user_id, 'doc' => $doc->id]) }}">Download</a> )</td>
                <td><a href="{{ route('dashboard.users.show', ['user' => $doc->user_id]) }}">{{ $doc->user_id }}</a></td>
                <td>
                    @if ($doc->bet)
                        <a href="{{ route('dashboard.bets.show', ['bet' => $doc->bet->id]) }}">{{ $doc->bet->id }}</a>
                    @endif
                </td>
                <td>
                    @if ($doc->bet)
                        {{ $doc->bet->win_amount }}
                    @endif
                </td>
                <td>{{ $doc->download_count }}</td>
                <td>{{ $doc->status }}</td>
                <td>{{ $doc->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('pagination.default', ['paginator' => $docs])
@endsection
