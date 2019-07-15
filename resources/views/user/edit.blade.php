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
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('email') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="email" type="text" id="email" value="{{ $user->email }}">
                        <label class="mdl-textfield__label" for="name">{{ __('Email') }}</label>
                        @error('email')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
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
                        <select-box v-bind:items="{{ json_encode($roles) }}" v-bind:selected="'{{ $user->role->name }}'" v-bind:send_name="'user_role'" v-bind:title="'User role'"/>
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