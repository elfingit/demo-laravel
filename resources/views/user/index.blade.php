@extends('layouts.crm.dashboard')
@section('crm_content')
    <h1>Users</h1>
    <div class="mdl-card search-filters">
        <form action="" method="get" id="user_search">
        <div class="mdl-card__title">
            <span>Filters:</span>
        </div>
        <div class="mdl-card__supporting-text">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="id" name="id" value="{{ old('id') ? old('id') : request('id') }}">
                <label class="mdl-textfield__label" for="id">ID</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="email" name="email" value="{{ old('email') ? old('email') : request('email') }}">
                <label class="mdl-textfield__label" for="email">Email</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="host" name="host" value="{{ old('host') ? old('host') : request('host') }}">
                <label class="mdl-textfield__label" for="host">Host</label>
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
            <th>Name</th>
            <th>Status</th>
            <th>Site</th>
            <th>Country</th>
            <th>Local Time</th>
            <th>Paid bets</th>
            <th>Pending bets</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>
                <a href="{{ route('dashboard.users.show', ['user' => $user->id]) }}">
                    @if($user->profile)
                    {{ $user->profile->first_name }} {{ $user->profile->last_name }}
                    @else
                        {{ $user->id }}
                    @endif
                </a>
            </td>
            <td>{{ $user->status }}</td>
            @if($user->profile)
            <td><img src="{{ $user->profile->favicon }}" height="25px"></td>
            @else
            <td>none</td>
            @endif
            <td>@if($user->profile) {{ $user->profile->country }} @endif</td>
            <td>
                @if($user->profile)
                    <user-local-time :time-zone="{{ $user->profile->time_zone }}" />
                @endif
            </td>
            <td>{{ $user->paid_bets }}</td>
            <td>{{ $user->pending_bets }}</td>
            <td>
                <a href="{{ route('dashboard.users.show', ['user' => $user->id]) }}" id="show"><i class="material-icons" role="presentation">visibility</i></a>
                <div class="mdl-tooltip" data-mdl-for="show">
                    Show user data
                </div>
                <a href="{{ route('dashboard.users.edit', ['user' => $user->id]) }}" id="edit"><i class="material-icons" role="presentation">edit</i></a>
                <div class="mdl-tooltip" data-mdl-for="edit">
                    Edit user data
                </div>
                <a href="{{ route('dashboard.users.available_balance.show', ['user' => $user->id]) }}" id="balance"><i class="material-icons" role="presentation">payment</i></a>
                <div class="mdl-tooltip" data-mdl-for="balance">
                    User balance
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
