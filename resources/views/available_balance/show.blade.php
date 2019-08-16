@extends('layouts.crm.dashboard')
@section('crm_content')
<user-available-balance
        :url-data="'{{ route('dashboard.crm_api.users.available_balance.index', ['user' => $user->id]) }}'"
        :url-add-balance="'{{ route('dashboard.crm_api.users.available_balance.store', ['user' => $user->id]) }}'"
        :url-transactions="'{{ route('dashboard.crm_api.users.transactions.index', ['user' => $user->id]) }}'">
</user-available-balance>
@endsection
