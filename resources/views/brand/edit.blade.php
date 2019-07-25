@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid form-panel">
        <div class="mdl-cell mdl-cell--8-col mdl-cell--6-col-tablet mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ __('Add new brand') }}</h2>
            </div>
            <form method="post" action="{{ route('dashboard.brands.update', ['brand' => $brand->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mdl-card__supporting-text">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('name') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="name" type="text" id="name" value="{{ $brand->name }}">
                        <label class="mdl-textfield__label" for="name">{{ __('Brand name') }}</label>
                        @error('name')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('code') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="code" type="text" id="code" value="{{ $brand->api_code }}">
                        <label class="mdl-textfield__label" for="code">{{ __('Brand code') }}</label>
                        @error('code')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <img src="{{ asset('images/logos/' . $brand->logo) }}" width="60%">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file @error('logo') is-invalid @enderror">
                        <input class="mdl-textfield__input" placeholder="{{ __('Logo') }}" type="text" id="uploadFile" readonly/>
                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                            <i class="material-icons">attach_file</i><input type="file" name="logo" id="uploadBtn">
                        </div>
                        @error('logo')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    @php
                        $componentErrors = [];
                    @endphp
                    @error('result_date')
                    @php
                        $componentErrors[] = $message;
                    @endphp
                    @enderror
                    @error('hours')
                    @php
                        $componentErrors[] = $message;
                    @endphp
                    @enderror
                    @error('minutes')
                    @php
                        $componentErrors[] = $message;
                    @endphp
                    @enderror
                    @error('period')
                    @php
                        $componentErrors[] = $message;
                    @endphp
                    @enderror

                    <game-date-draw-picker :income-days="{{ json_encode($brand->checkDates) }}"  :errors="{{ json_encode($componentErrors) }}"></game-date-draw-picker>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('tickets_count') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="tickets_count" type="text" id="tickets_count" value="{{ $brand->tickets_count }}">
                        <label class="mdl-textfield__label" for="tickets_count">{{ __('Tickets count') }}</label>
                        @error('tickets_count')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('default_quick_pick') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="default_quick_pick" type="text" id="default_quick_pick" value="{{ implode(',', $brand->default_quick_pick) }}">
                        <label class="mdl-textfield__label" for="default_quick_pick">{{ __('Default quick pick') }}</label>
                        @error('default_quick_pick')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('primary_pool') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="primary_pool" type="number" id="primary_pool" value="{{ $brand->primary_pool }}">
                        <label class="mdl-textfield__label" for="primary_pool">{{ __('Primary pool') }}</label>
                        @error('primary_pool')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('primary_pool_combination') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="primary_pool_combination" type="number" id="primary_pool_combination" value="{{ $brand->primary_pool_combination }}">
                        <label class="mdl-textfield__label" for="primary_pool_combination">{{ __('Primary pool combination') }}</label>
                        @error('primary_pool_combination')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('special_pool') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="special_pool" type="number" id="special_pool" value="{{ $brand->special_pool }}">
                        <label class="mdl-textfield__label" for="special_pool">{{ __('Special pool') }}</label>
                        @error('special_pool')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('special_pool_combination') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="special_pool_combination" type="number" id="special_pool_combination" value="{{ $brand->special_pool_combination }}">
                        <label class="mdl-textfield__label" for="special_pool_combination">{{ __('Special pool combination') }}</label>
                        @error('special_pool_combination')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('name_of_special_pool') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="name_of_special_pool" type="text" id="name_of_special_pool" value="{{ $brand->name_of_special_pool }}">
                        <label class="mdl-textfield__label" for="name_of_special_pool">{{ __('Name of special pool') }}</label>
                        @error('name_of_special_pool')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="duration">
                            <input type="checkbox" value="1" class="mdl-checkbox__input" name="duration" id="duration" {{ $brand->duration ? 'checked' : '' }}>
                            <span class="mdl-checkbox__label">{{ __('Duration') }}</span>
                        </label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="subscription">
                            <input type="checkbox" value="1" class="mdl-checkbox__input" name="subscription" id="subscription" {{ $brand->subscription ? 'checked' : '' }}>
                            <span class="mdl-checkbox__label">{{ __('Subscription') }}</span>
                        </label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="jackpot_hut">
                            <input type="checkbox" value="1" class="mdl-checkbox__input" name="jackpot_hut" id="jackpot_hut" {{ $brand->jackpot_hut ? 'checked' : '' }}>
                            <span class="mdl-checkbox__label">{{ __('Jackpot hut') }}</span>
                        </label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="participation">
                            <input type="checkbox" value="1" class="mdl-checkbox__input" name="participation" id="participation" {{ $brand->participation ? 'checked' : '' }}>
                            <span class="mdl-checkbox__label">{{ __('Participation') }}</span>
                        </label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="extra_game">
                            <input type="checkbox" value="1" class="mdl-checkbox__input" name="extra_game" id="extra_game" {{ $brand->extra_game ? 'checked' : '' }}>
                            <span class="mdl-checkbox__label">{{ __('Extra game') }}</span>
                        </label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield @error('extra_game_type') is-invalid @enderror">
                        <select name="extra_game_type" id="extra_game_type">
                            <option value="base" @if($brand->extra_game_type == 'base') selected @endif>Base</option>
                            <option value="per_ticket" @if($brand->extra_game_type == 'per_ticket') selected @endif>Per ticket</option>
                        </select>
                        <label for="extra_game_type">{{ __('Extra game type') }}</label>
                        @error('extra_game_type')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="jackpot_multiplier">
                            <input type="checkbox" value="1" class="mdl-checkbox__input" name="jackpot_multiplier" id="jackpot_multiplier" {{ $brand->jackpot_multiplier ? 'checked' : '' }}>
                            <span class="mdl-checkbox__label">{{ __('Jackpot multiplier') }}</span>
                        </label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="number_shield">
                            <input type="checkbox" value="1" class="mdl-checkbox__input" name="number_shield" id="number_shield" {{ $brand->number_shield ? 'checked' : '' }}>
                            <span class="mdl-checkbox__label">{{ __('Number shield') }}</span>
                        </label>
                    </div>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--colored">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection