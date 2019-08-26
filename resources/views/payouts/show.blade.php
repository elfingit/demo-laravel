@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">{{ __('Payout') }} : {{ $payout->id }}</h2>
                    &nbsp;
                    <payout-status
                        :statuses="{{ json_encode(\Payout::getStatuses()) }}"
                        status="{{ $payout->status }}"
                        :disable="{{ $payout->status == \App\Model\UserPayoutRequest::STATUS_PENDING ? 'false' : 'true' }}"
                        payout-id="{{ $payout->id }}"/>
                </div>
                <div class="mdl-card__supporting-text mdl-grid">
                    <div class="mdl-list">
                        <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('ID') }}:</b></span>
                                </span>
                            <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">{{ $payout->id }}</span>
                                </span>
                        </div>
                        <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('Client') }}:</b></span>
                                </span>
                            <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">
                                        <a href="{{ route('dashboard.users.show', ['user' => $payout->user_id]) }}">{{ $payout->user_id }}</a>
                                    </span>
                                </span>
                        </div>
                        <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('Amount') }}:</b></span>
                                </span>
                            <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">
                                        {{ $payout->amount }}
                                    </span>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
