@extends('layouts.crm')

@section('content')
    <div class="demo-layout mdl-layout mdl-js-layout login-page" id="app">
        <main class="mdl-layout__content">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-shadow--2dp login-container">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">{{ __('Reset Password') }}</h2>
                    </div>
                    <form method="post" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mdl-card__supporting-text">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('email') is-invalid @enderror">
                                <input class="mdl-textfield__input" name="email" type="email" id="email" value="{{ old('email') }}" required>
                                <label class="mdl-textfield__label" for="email">{{ __('E-Mail Address') }}</label>
                                @error('email')
                                <span class="mdl-textfield__error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--colored">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @if(session('status'))
                <tooltip message="{{ session('status') }}"></tooltip>
            @endif
        </main>
    </div>
@endsection
