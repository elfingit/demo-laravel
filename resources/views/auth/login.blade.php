@extends('layouts.crm')

@section('content')
    <div class="demo-layout mdl-layout mdl-js-layout login-page" id="app">
        <main class="mdl-layout__content">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--6-col mdl-cell--4-col-tablet mdl-shadow--2dp login-container">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">{{ __('Login') }}</h2>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="mdl-card__supporting-text">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input @error('email') is-invalid @enderror" type="email" id="email">
                                <label class="mdl-textfield__label" for="email">{{ __('E-Mail Address') }}</label>
                                @error('email')
                                <span class="mdl-textfield__error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input @error('password') is-invalid @enderror" type="password" id="password">
                                <label class="mdl-textfield__label" for="password">{{ __('Password') }}</label>
                                @error('password')
                                <span class="mdl-textfield__error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mdl-textfield mdl-js-textfield">
                                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
                                    <input type="checkbox" class="mdl-checkbox__input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="mdl-checkbox__label">{{ __('Remember Me') }}</span>
                                </label>
                            </div>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <div class="mdl-grid">
                            <div class="mdl-cell">
                                <button type="submit" class="mdl-button mdl-js-button">{{ __('Login') }}</button>
                            </div>
                            @if (Route::has('password.request'))
                                <div class="mdl-layout-spacer"></div>
                                <div class="mdl-cell">
                                    <a class="mdl-button mdl-js-button" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection
