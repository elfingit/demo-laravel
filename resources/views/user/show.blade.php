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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection