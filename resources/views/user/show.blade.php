@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">{{ __('User data') }} : {{ $user->email }}</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <div class="mdl-list">
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('User ID') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $user->id }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('User role') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $user->role->name }}</span>
                            </span>
                        </div>
                        @if($user->profile)
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Honorific') }}:</b></span>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $user->profile->honorific }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('User name') }}:</b></span>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $user->profile->first_name }} {{ $user->profile->last_name }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Birthday') }}:</b></span>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $user->profile->date_of_birth->format('m-d-Y') }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Country') }}:</b></span>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $user->profile->country }}</span>
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection