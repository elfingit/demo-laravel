@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid">
        <a href="{{ route('dashboard.brands.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">{{ __('Add new brand') }}</a>
    </div>
@endsection