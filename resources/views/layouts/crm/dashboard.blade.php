@extends('layouts.crm')
@section('content')
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer">
        <div class="mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
            <span class="mdl-layout-title">{{ __('BLV CRM') }}</span>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="{{ route('dashboard.brands.index') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">pages</i>{{ __('Brands') }}</a>
                <a class="mdl-navigation__link" href="{{ route('dashboard.leads.index') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">contacts</i>{{ __('Leads') }}</a>
                <a class="mdl-navigation__link" href="{{ route('dashboard.users.index') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">face</i>{{ __('Users') }}</a>
            </nav>
        </div>
        <main class="mdl-layout__content" id="app">
            <div class="page-content">
                @yield('crm_content')
            </div>
        </main>
    </div>
@endsection