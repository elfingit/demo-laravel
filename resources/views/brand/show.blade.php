@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <img src="{{ asset('images/logos/' . $brand->logo) }}">
        </div>
        <div class="mdl-cell mdl-cell--5-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">{{ $brand->name }}</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <div class="mdl-list">
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Country') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->country }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('State') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->state }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Main mix') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->main_min }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Main max') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->main_max }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Main drawn') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->main_drawn }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Bonus min') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->bonus_min }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Bonus max') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->bonus_max }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Bonus drawn') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->bonus_drawn }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Same balls') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->same_balls }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Digits') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->digits }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Drawn') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->drawn }}</span>
                            </span>
                        </div>
                        @if ($brand->option_desc)
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Option description') }}:</b></span>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->option_desc }}</span>
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="md-cell md-cell--5-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">{{ __('Prices') }}</h2>
                </div>
            </div>
        </div>
    </div>
@endsection