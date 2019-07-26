@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <img src="{{ asset('images/logos/' . $brand->logo) }}">
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">{{ __('Game data') }} : {{ $brand->name }}</h2>
                </div>
                <div class="mdl-card__supporting-text mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-list">
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Jackpot multiplier') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->jackpot_multiplier ? 'Yes' : 'No' }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Number shield') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->number_shield ? 'Yes' : 'No' }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Tickets count') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->tickets_count }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Default quick pick') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ implode(',', $brand->default_quick_pick) }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Primary pool') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->primary_pool }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Combination of primary pool') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->primary_pool_combination }}</span>
                            </span>
                        </div>
                        <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Special pool') }}:</b></span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->special_pool }}</span>
                            </span>
                        </div>


                    </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="mdl-list">
                            <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Combination of special pool') }}:</b></span>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->special_pool_combination }}</span>
                            </span>
                            </div>
                            <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Name of special pool') }}:</b></span>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->name_of_special_pool }}</span>
                            </span>
                            </div>
                            <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Duration') }}:</b></span>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->duration ? 'Yes' : 'No' }}</span>
                            </span>
                            </div>
                            <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Subscription') }}:</b></span>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->subscription  ? 'Yes' : 'No'}}</span>
                            </span>
                            </div>
                            <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Jackpot hut') }}:</b></span>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->jackpot_hut  ? 'Yes' : 'No'}}</span>
                            </span>
                            </div>
                            <div class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <span><b>{{ __('Participation') }}:</b></span>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <span class="mdl-list__item-text-body">{{ $brand->participation  ? 'Yes' : 'No'}}</span>
                            </span>
                            </div>
                            <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('Extra game') }}:</b></span>
                                </span>
                                <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">{{ $brand->extra_game  ? 'Yes' : 'No'}}</span>
                                </span>
                            </div>
                            <div class="mdl-list__item">
                                <span class="mdl-list__item-primary-content">
                                    <span><b>{{ __('Extra game type') }}:</b></span>
                                </span>
                                <span class="mdl-list__item-secondary-content">
                                    <span class="mdl-list__item-text-body">{{ $brand->extra_game_type }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="mdl-cell @if($brand->extra_game) mdl-cell--6-col @else mdl-cell--6-col @endif">
                <div class="mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">{{ __('Prices') }}</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <brand-prices brand_id="{{ $brand->id }}"></brand-prices>
                    </div>
                </div>
            </div>
            @if($brand->extra_game)
            <div class="mdl-cell mdl-cell--6-col">
                <div class="mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">{{ __('Extra games') }}</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <brand-extra-games brand_id="{{ $brand->id }}" />
                    </div>
                </div>
            </div>
            @endif
        @if($brand->results->count() > 0)
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-card mdl-shadow--2dp table-container">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">{{ __('Draw data') }}</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                        <thead>
                        <tr>
                            <th>Draw date</th>
                            <th>Result</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($brand->results as $result)
                        <tr>
                            <td>{{ $result->draw_date }}</td>
                            <td>@include('brand._result_'.$brand->api_code, ['result' => $result])</td>
                            <td>{{ $result->created_at }}</td>
                            <td>{{ $result->updated_at }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
