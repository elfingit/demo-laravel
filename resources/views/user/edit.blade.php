@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid form-panel">
        <div class="mdl-cell mdl-cell--8-col mdl-cell--6-col-tablet mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ __('User edit') }}</h2>
            </div>
            <form method="post" action="{{ route('dashboard.users.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mdl-card__supporting-text">
                    <div class="mdl-textfield mdl-js-textfield getmdl-select @error('honorific') is-invalid @enderror">
                        <input type="text" value="" class="mdl-textfield__input" id="honorific" readonly>
                        <input type="hidden" value="" name="honorific">
                        <label for="honorific" class="mdl-textfield__label">{{ __('Honorific') }}</label>
                        @error('honorific')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                        <ul for="honorific" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                            <li class="mdl-menu__item" data-val="mr" {{ $user->profile ? ($user->profile->honorific == 'mr' ? 'data-selected="true"' : '') : '' }}>Mr</li>
                            <li class="mdl-menu__item" data-val="mrs" {{ $user->profile ? ($user->profile->honorific == 'mrs' ? 'data-selected="true"' : '') : '' }}>Mrs</li>
                        </ul>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('first_name') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="first_name" type="text" id="first_name" value="{{ $user->profile ? $user->profile->first_name : '' }}">
                        <label class="mdl-textfield__label" for="first_name">{{ __('First name') }}</label>
                        @error('first_name')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('last_name') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="last_name" type="text" id="last_name" value="{{ $user->profile ? $user->profile->last_name : '' }}">
                        <label class="mdl-textfield__label" for="last_name">{{ __('Last name') }}</label>
                        @error('last_name')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('email') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="email" type="text" id="email" value="{{ $user->email }}">
                        <label class="mdl-textfield__label" for="name">{{ __('Email') }}</label>
                        @error('email')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('phone') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="phone" type="text" id="phone" value="{{ $user->profile ? $user->profile->phone : '' }}">
                        <label class="mdl-textfield__label" for="phone">{{ __('Phone') }}</label>
                        @error('phone')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="email_subscription">
                        <input type="checkbox" id="email_subscription" class="mdl-checkbox__input">
                        <span class="mdl-checkbox__label">Email subscription</span>
                        @error('email_subscription')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </label>
                    <div class="mdl-textfield mdl-js-textfield getmdl-select getmdl-select__fix-height @error('country') is-invalid @enderror">
                        <input type="text" value="" class="mdl-textfield__input" id="country" readonly>
                        <input type="hidden" value="" name="country">
                        <label for="country" class="mdl-textfield__label">{{ __('Country') }}</label>
                        @error('country')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                        <ul for="country" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                            @foreach (config('countries') as $country)
                            <li class="mdl-menu__item" data-val="{{ $country }}" {{ $user->profile ? ($user->profile->country == $country ? 'data-selected="true"' : '') : '' }}>{{ $country }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('password') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="password" type="password" id="password" value="">
                        <label class="mdl-textfield__label" for="password">{{ __('Password') }}</label>
                        @error('password')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="password_confirmation" type="password" id="password_confirmation" value="">
                        <label class="mdl-textfield__label" for="password_confirmation">{{ __('Password confirmation') }}</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('user_role') is-invalid @enderror">
                        <select-box v-bind:send="'{{ $user->role->id }}'" v-bind:items="{{ json_encode($roles) }}" v-bind:selected="'{{ $user->role->name }}'" v-bind:send_name="'user_role'" v-bind:title="'User role'"/>
                        @error('user_role')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--colored">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
