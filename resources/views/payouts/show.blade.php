@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">{{ __('Payout') }}</h2>
                </div>
                <div class="mdl-card__supporting-text mdl-grid">
                    <div class="mdl-list">
                        <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('Host') }}:</b></span>
                                </span>
                            <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">{{ $payout->id }}</span>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
