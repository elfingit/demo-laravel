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
            <th># ID</th>
            <th>Favicon</th>
            <th>Host</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            @if($user->profile)
            <td>{{ $user->profile->favicon }}</td>
            <td>{{ $user->profile->host }}</td>
            @else
            <td>none</td>
            <td>none</td>
            @endif
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->name }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection